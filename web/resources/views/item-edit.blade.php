@extends('layouts.app')
@section('c')
<a href="/barang" class="text-sm text-black/50 hover:text-black">&larr; Kembali ke barang</a>
<h1 class="h1 mt-3 mb-6">Ubah {{ $item->name }}</h1>
<form method="post" action="/barang/{{ $item->id }}" class="grid sm:grid-cols-2 gap-4 max-w-2xl text-sm">@csrf @method('PUT')
  @foreach([['name','Nama barang','text'],['category','Kategori','text'],['buy_price','Harga beli','number'],['sell_price','Harga jual','number'],['stock','Stok','number'],['min_stock','Batas minimum stok','number']] as [$n,$l,$t])
    <div><label class="block font-semibold mb-1.5">{{ $l }}</label>
    <input name="{{ $n }}" type="{{ $t }}" value="{{ old($n, $item->$n) }}" class="inp w-full" required></div>
  @endforeach
  @if($errors->any())<p class="text-red-700 sm:col-span-2">Data belum lengkap atau tidak valid.</p>@endif
  <div class="sm:col-span-2"><button class="btn">Simpan perubahan</button></div>
</form>
@endsection
