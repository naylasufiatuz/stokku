@extends('layouts.app')
@section('c')
<h1 class="h1 mb-2">Karyawan</h1>
<p class="text-black/60 mb-6 max-w-lg">Karyawan bisa mencatat penjualan dan melihat stok. Menambah atau mengubah barang tetap hanya untuk pemilik.</p>
<form method="post" action="/karyawan" class="flex flex-wrap gap-2 mb-2 text-sm">@csrf
  <input name="name" placeholder="Nama" class="inp" required>
  <input name="email" type="email" placeholder="Email" class="inp" required>
  <input name="password" type="text" placeholder="Kata sandi (min. 6)" class="inp" required>
  <button class="btn">Tambah karyawan</button>
</form>
@if($errors->any())<p class="text-sm text-red-700 mb-2">{{ $errors->first() }}</p>@endif
<div class="card overflow-x-auto mt-6">
<table class="w-full text-sm">
  <thead class="text-left text-black/50"><tr class="border-b border-black/10"><th class="p-4 font-semibold">Nama</th><th class="p-4 font-semibold">Email</th><th></th></tr></thead>
  <tbody>@forelse($staff as $u)
    <tr class="border-b border-black/5 last:border-0"><td class="p-4 font-medium">{{ $u->name }}</td><td class="p-4 text-black/50">{{ $u->email }}</td>
      <td class="p-4 text-right"><form method="post" action="/karyawan/{{ $u->id }}" onsubmit="return confirm('Hapus akun {{ $u->name }}?')">@csrf @method('DELETE')<button class="text-black/50 hover:text-red-700">Hapus</button></form></td></tr>
  @empty<tr><td class="p-6 text-black/50" colspan="3">Belum ada karyawan.</td></tr>@endforelse</tbody>
</table></div>
@endsection
