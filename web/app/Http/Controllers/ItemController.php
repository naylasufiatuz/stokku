<?php
namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller {
    private function rules(): array {
        return ['name' => 'required|string|max:100', 'category' => 'required|string|max:50',
            'buy_price' => 'required|integer|min:0', 'sell_price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0', 'min_stock' => 'required|integer|min:0'];
    }
    public function index(Request $r) {
        $q = Item::orderBy('name');
        if ($r->q) $q->where('name', 'like', '%' . $r->q . '%');
        return view('items', ['items' => $q->get()]);
    }
    public function store(Request $r) { Item::create($r->validate($this->rules())); return back(); }
    public function edit(Item $item) { return view('item-edit', ['item' => $item]); }
    public function update(Request $r, Item $item) { $item->update($r->validate($this->rules())); return redirect('/barang'); }
    public function restock(Request $r, Item $item) {
        $item->increment('stock', $r->validate(['qty' => 'required|integer|min:1'])['qty']);
        return back();
    }
    public function destroy(Item $item) { $item->delete(); return back(); }
}
