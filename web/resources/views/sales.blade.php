@extends('layouts.app')
@section('c')
<div class="flex items-center justify-between mb-6">
  <h1 class="h1">Penjualan</h1>
  <a href="/penjualan/ekspor" class="btn-lime">Unduh CSV</a>
</div>
@if($items->isEmpty())
  <div class="card p-6 mb-6 text-sm">Belum ada barang yang bisa dijual. @if(auth()->user()->role === 'pemilik')<a href="/barang" class="font-bold underline">Tambah barang dulu</a>.@else Minta pemilik toko menambah barang.@endif</div>
@else
<form method="post" action="/penjualan" class="flex flex-wrap gap-2 mb-2 text-sm">@csrf
  <select name="item_id" class="inp" required>
    @foreach($items as $i)<option value="{{ $i->id }}">{{ $i->name }} (stok {{ $i->stock }})</option>@endforeach
  </select>
  <input name="qty" type="number" min="1" value="1" class="w-24 inp" required>
  <button class="btn">Catat penjualan</button>
</form>
@error('qty')<p class="text-sm text-red-700 mb-2">{{ $message }}</p>@enderror
@endif
<form class="flex flex-wrap items-center gap-2 my-6 text-sm">
  <span class="text-black/50">Tanggal</span>
  <input type="date" name="dari" value="{{ request('dari') }}" class="inp !py-1.5">
  <span class="text-black/50">sampai</span>
  <input type="date" name="sampai" value="{{ request('sampai') }}" class="inp !py-1.5">
  <button class="btn-lime !py-1.5">Terapkan</button>
</form>
<div class="card overflow-x-auto">
<table class="w-full text-sm">
  <thead class="text-left text-black/50"><tr class="border-b border-black/10">
    <th class="p-4 font-semibold">Tanggal</th><th class="p-4 font-semibold">Barang</th><th class="p-4 font-semibold">Jumlah</th>
    <th class="p-4 font-semibold">Total</th><th class="p-4 font-semibold">Dicatat oleh</th><th></th></tr></thead>
  <tbody>@forelse($sales as $s)
    <tr class="border-b border-black/5 last:border-0">
      <td class="p-4 text-black/50">{{ $s->sold_on }}</td><td class="p-4 font-medium">{{ $s->item->name }}</td>
      <td class="p-4">{{ $s->qty }}</td><td class="p-4">Rp {{ number_format($s->qty * $s->price, 0, ',', '.') }}</td>
      <td class="p-4 text-black/50">{{ $s->user->name ?? '-' }}</td>
      <td class="p-4 text-right">@if(auth()->user()->role === 'pemilik' || $s->user_id === auth()->id())
        <form method="post" action="/penjualan/{{ $s->id }}" onsubmit="return confirm('Batalkan penjualan ini? Stok akan dikembalikan.')">@csrf @method('DELETE')
        <button class="text-black/50 hover:text-red-700">Batalkan</button></form>@endif</td>
    </tr>
  @empty<tr><td class="p-6 text-black/50" colspan="6">Belum ada penjualan. Catat yang pertama dengan formulir di atas.</td></tr>@endforelse</tbody>
</table></div>
@endsection
