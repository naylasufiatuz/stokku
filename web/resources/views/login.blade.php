<!doctype html>
<html lang="id">
<head>@include('layouts.head')<title>Masuk - StokKu</title></head>
<body class="min-h-screen grid md:grid-cols-2">
<div class="bg-[#C6F432] p-8 md:p-12 flex flex-col justify-between min-h-[200px]">
  <a href="/" class="flex items-center gap-2 font-extrabold text-lg">
    <span class="w-7 h-7 rounded-lg bg-black grid place-items-center"><span class="w-2.5 h-2.5 rounded-sm bg-[#C6F432]"></span></span>StokKu
  </a>
  <p class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight mt-10">Stok aman,<br>untung kelihatan.</p>
</div>
<div class="flex items-center justify-center p-8">
  <form method="post" action="/masuk" class="w-full max-w-sm">@csrf
    <h1 class="text-3xl font-extrabold mb-6">Masuk</h1>
    <label class="block text-sm font-semibold mb-1.5">Email</label>
    <input name="email" type="email" value="{{ old('email') }}" class="inp w-full mb-4" required>
    <label class="block text-sm font-semibold mb-1.5">Kata sandi</label>
    <input name="password" type="password" class="inp w-full mb-4" required>
    @error('email')<p class="text-sm text-red-700 mb-3">{{ $message }}</p>@enderror
    <button class="btn w-full">Masuk</button>
    <p class="text-sm text-black/60 mt-5">Belum punya akun? <a href="/daftar" class="font-bold text-black underline">Daftar</a></p>
  </form>
</div>
</body>
</html>
