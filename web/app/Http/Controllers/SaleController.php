<?php
namespace App\Http\Controllers;
use App\Models\{Item, Sale};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller {
    public function index(Request $r) {
        $s = Sale::with('item', 'user')->latest('sold_on')->latest('id');
        if ($r->dari) $s->where('sold_on', '>=', $r->dari);
        if ($r->sampai) $s->where('sold_on', '<=', $r->sampai);
        return view('sales', ['items' => Item::orderBy('name')->get(), 'sales' => $s->limit(100)->get()]);
    }
    public function store(Request $r) {
        $d = $r->validate(['item_id' => 'required|exists:items,id', 'qty' => 'required|integer|min:1']);
        $it = Item::findOrFail($d['item_id']);
        if ($it->stock < $d['qty']) return back()->withErrors(['qty' => "Stok {$it->name} tinggal {$it->stock}."]);
        DB::transaction(function () use ($it, $d, $r) {
            $it->decrement('stock', $d['qty']);
            Sale::create(['item_id' => $it->id, 'user_id' => $r->user()->id, 'qty' => $d['qty'],
                'price' => $it->sell_price, 'sold_on' => now()->toDateString()]);
        });
        return back();
    }
    // Batalkan penjualan: stok dikembalikan. Karyawan hanya bisa membatalkan catatannya sendiri.
    public function destroy(Request $r, Sale $sale) {
        abort_unless($r->user()->role === 'pemilik' || $sale->user_id === $r->user()->id, 403, 'Kamu hanya bisa membatalkan catatanmu sendiri.');
        DB::transaction(function () use ($sale) { $sale->item?->increment('stock', $sale->qty); $sale->delete(); });
        return back();
    }
    public function export() {
        return response()->streamDownload(function () {
            $f = fopen('php://output', 'w');
            fputcsv($f, ['Tanggal', 'Barang', 'Jumlah', 'Harga', 'Total']);
            Sale::with('item')->orderBy('sold_on')->chunk(500, function ($rows) use ($f) {
                foreach ($rows as $s) fputcsv($f, [$s->sold_on, $s->item->name, $s->qty, $s->price, $s->qty * $s->price]);
            });
            fclose($f);
        }, 'penjualan.csv');
    }
}
