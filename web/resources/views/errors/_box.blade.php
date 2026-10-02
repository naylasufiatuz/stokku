<!doctype html>
<html lang="id">
<head>@include('layouts.head')<title>{{ $code }} - StokKu</title></head>
<body class="min-h-screen grid place-items-center p-8">
  <div class="max-w-md">
    <p class="text-8xl font-extrabold bg-[#C6F432] inline-block px-4 rounded-3xl">{{ $code }}</p>
    <h1 class="text-3xl font-extrabold mt-6">{{ $title }}</h1>
    <p class="text-black/60 mt-2">{{ $text }}</p>
    <a href="/" class="btn mt-8">Kembali ke beranda</a>
  </div>
</body>
</html>
