<?php
namespace Database\Seeders;
use App\Models\{Item, Sale, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $store = \App\Models\Store::create(['name' => 'Warung Bu Sari']);
        $owner = User::forceCreate(['store_id' => $store->id, 'name' => 'Bu Sari', 'email' => 'owner@stokku.test', 'password' => Hash::make('password'), 'role' => 'pemilik']);
        User::forceCreate(['store_id' => $store->id, 'name' => 'Dimas', 'email' => 'karyawan@stokku.test', 'password' => Hash::make('password'), 'role' => 'karyawan']);

        // nama, kategori, harga beli, harga jual, rata-rata terjual/hari, stok, batas minimum
        $data = [
            ['Kopi susu', 'Minuman', 6000, 12000, 18, 40, 15], ['Es teh', 'Minuman', 1500, 4000, 25, 60, 20],
            ['Air mineral', 'Minuman', 2000, 4000, 15, 80, 20], ['Gula 1 kg', 'Sembako', 14000, 17000, 4, 8, 6],
            ['Beras 5 kg', 'Sembako', 62000, 70000, 2, 12, 5], ['Minyak goreng 1 L', 'Sembako', 15000, 18000, 4, 18, 8],
            ['Telur 1 kg', 'Sembako', 26000, 30000, 5, 6, 8], ['Mi instan', 'Makanan', 2800, 3500, 20, 90, 30],
            ['Roti coklat', 'Makanan', 4000, 6500, 9, 14, 10], ['Keripik singkong', 'Makanan', 5000, 8000, 7, 25, 10],
            ['Rokok', 'Lainnya', 25000, 28000, 8, 30, 10], ['Sabun mandi', 'Lainnya', 2500, 4000, 4, 20, 8],
        ];
        mt_srand(7);
        $rows = [];
        foreach ($data as $k => [$n, $c, $b, $s, $base, $stock, $min]) {
            $it = Item::create(['store_id' => $store->id, 'name' => $n, 'category' => $c, 'buy_price' => $b, 'sell_price' => $s, 'stock' => $stock, 'min_stock' => $min]);
            for ($d = 59; $d >= 0; $d--) {
                $date = now()->subDays($d);
                $f = $date->isWeekend() ? 1.3 : 1;
                $trend = ($k % 4 == 0 && $d < 10) ? 1.35 : 1; // beberapa barang naik di 10 hari terakhir
                $qty = max(0, (int) round($base * $f * $trend + mt_rand(-2, 2)));
                if ($qty) $rows[] = ['store_id' => $store->id, 'item_id' => $it->id, 'user_id' => $owner->id, 'qty' => $qty, 'price' => $s,
                    'sold_on' => $date->toDateString(), 'created_at' => now(), 'updated_at' => now()];
            }
        }
        foreach (array_chunk($rows, 200) as $chunk) Sale::insert($chunk);
    }
}
