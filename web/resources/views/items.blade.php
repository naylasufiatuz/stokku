@extends('layouts.app')
@section('c')
@php $owner = auth()->user()->role === 'pemilik'; @endphp
<h1 class="h1 mb-6">Barang</h1>
@if($owner)
<form method="post" action="/barang" class="grid grid-cols-2 md:grid-cols-6 gap-2 mb-2 text-sm">@csrf
  <input name="name" placeholder="Nama barang" class="col-span-2 inp" required>
  <input name="category" placeholder="Kategori" class="inp" required>
  <input name="buy_price" type="number" min="0" placeholder="Harga beli" class="inp" required>
  <input name="sell_price" type="number" min="0" placeholder="Harga jual" class="inp" required>
  <input name="stock" type="number" min="0" placeholder="Stok awal" class="inp" required>
  <input name="min_stock" type="number" min="0" placeholder="Batas minimum" class="inp md:col-span-2" required>
  <button class="btn md:col-span-2">Tambah barang</button>
</form>
@if($errors->any())<p class="text-sm text-red-700 mb-2">Data belum lengkap atau tidak valid.</p>@endif
@endif
<form class="my-5"><input name="q" value="{{ request('q') }}" placeholder="Cari barang..." class="inp w-full md:w-72"></form>
<div class="card overflow-x-auto">
<table class="w-full text-sm">
  <thead class="text-left text-black/50"><tr class="border-b border-black/10">
    <th class="p-4 font-semibold">Nama</th><th class="p-4 font-semibold">Kategori</th>
    <th class="p-4 font-semibold">Harga jual</th><th class="p-4 font-semibold">Stok</th><th></th></tr></thead>
  <tbody>@forelse($items as $i)
    <tr class="border-b border-black/5 last:border-0">
      <td class="p-4 font-medium">{{ $i->name }}</td><td class="p-4 text-black/50">{{ $i->category }}</td>
      <td class="p-4">Rp {{ number_format($i->sell_price, 0, ',', '.') }}</td>
      <td class="p-4">
        <span class="{{ $i->stock <= $i->min_stock ? 'px-2.5 py-0.5 rounded-full bg-black text-white text-xs font-semibold' : 'font-medium' }}">{{ $i->stock }}</span>
        @if($owner)
        <form method="post" action="/barang/{{ $i->id }}/stok" class="inline-flex gap-1 ml-3">@csrf
          <input name="qty" type="number" min="1" placeholder="+ stok" class="inp !py-1 !px-3 w-24" required>
          <button class="btn-lime !py-1 !px-3">Tambah</button>
        </form>@endif
      </td>
      <td class="p-4 text-right whitespace-nowrap">@if($owner)
        <a href="/barang/{{ $i->id }}/ubah" class="text-black/50 hover:text-black mr-3">Ubah</a>
        <form method="post" action="/barang/{{ $i->id }}" class="inline" onsubmit="return confirm('Hapus {{ $i->name }}? Riwayat penjualannya ikut terhapus.')">@csrf @method('DELETE')
        <button class="text-black/50 hover:text-red-700">Hapus</button></form>@endif</td>
    </tr>
  @empty<tr><td class="p-6 text-black/50" colspan="5">{{ request('q') ? 'Barang tidak ditemukan.' : ($owner ? 'Belum ada barang. Isi formulir di atas untuk menambah barang pertama.' : 'Belum ada barang. Minta pemilik toko menambahkannya.') }}</td></tr>@endforelse</tbody>
</table></div>
@endsection
