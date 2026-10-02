<!doctype html>
<html lang="id">
<head>@include('layouts.head')<title>@yield('title', 'StokKu')</title></head>
<body class="min-h-screen">
<header class="px-5 md:px-10 py-5 flex items-center gap-4 flex-wrap max-w-6xl mx-auto">
  <a href="/" class="flex items-center gap-2 font-extrabold text-lg">
    <span class="w-7 h-7 rounded-lg bg-black grid place-items-center"><span class="w-2.5 h-2.5 rounded-sm bg-[#C6F432]"></span></span>StokKu
  </a>
  <nav class="flex gap-1 text-sm font-semibold bg-black/5 rounded-full p-1 md:mx-auto">
    @foreach(['/ringkasan' => 'Ringkasan', '/penjualan' => 'Penjualan', '/barang' => 'Barang'] + (auth()->user()->role === 'pemilik' ? ['/karyawan' => 'Karyawan'] : []) as $u => $t)
      <a href="{{ $u }}" class="px-4 py-1.5 rounded-full {{ request()->is(ltrim($u, '/') . '*') ? 'bg-black text-white' : 'hover:bg-black/5' }}">{{ $t }}</a>
    @endforeach
  </nav>
  <form method="post" action="/keluar" class="ml-auto md:ml-0">@csrf
    <button class="btn">Keluar, {{ strtok(auth()->user()->name, ' ') }}</button>
  </form>
</header>
<main class="px-5 md:px-10 pt-6 pb-16 max-w-6xl mx-auto">@yield('c')</main>
</body>
</html>
