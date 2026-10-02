<?php
namespace App\Http\Controllers;
use App\Models\{Item, Sale};
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller {
    public function index() {
        $perDay = [];
        for ($i = 29; $i >= 0; $i--) $perDay[now()->subDays($i)->toDateString()] = 0;

        $hist = [];
        foreach (Sale::where('sold_on', '>=', array_key_first($perDay))->get() as $s) {
            $perDay[$s->sold_on] += $s->qty * $s->price;
            $hist[$s->item_id][$s->sold_on] = ($hist[$s->item_id][$s->sold_on] ?? 0) + $s->qty;
        }

        $items = Item::all();
        $payload = $items->map(fn ($it) => [
            'id' => $it->id, 'name' => $it->name, 'stock' => $it->stock,
            'history' => array_map(fn ($d) => $hist[$it->id][$d] ?? 0, array_keys($perDay)),
        ])->values();

        try {
            $pred = Http::timeout(3)->post(env('AI_URL', 'http://127.0.0.1:8001') . '/predict', ['items' => $payload])->json('items');
        } catch (\Throwable $e) { $pred = null; }

        $notes = [];
        foreach ($pred ?? [] as $p) {
            if ($p['trend'] === 'naik') $notes[] = "{$p['name']} naik {$p['change_pct']}% minggu ini.";
            if ($p['days_left'] !== null && $p['days_left'] <= 3) $notes[] = "Stok {$p['name']} cukup sekitar {$p['days_left']} hari lagi.";
        }

        return view('dashboard', [
            'perDay' => $perDay, 'itemCount' => $items->count(), 'saleCount' => Sale::count(), 'days' => count(array_filter($perDay)), 'pred' => $pred, 'notes' => $notes,
            'today' => $perDay[now()->toDateString()] ?? 0,
            'low' => $items->filter(fn ($i) => $i->stock <= $i->min_stock),
        ]);
    }
}
