<!doctype html>
<html lang="id">
<head>@include('layouts.head')<title>Daftar - StokKu</title></head>
<body class="min-h-screen grid md:grid-cols-2">
<div class="bg-[#C6F432] p-8 md:p-12 flex flex-col justify-between min-h-[200px]">
  <a href="/" class="flex items-center gap-2 font-extrabold text-lg">
    <span class="w-7 h-7 rounded-lg bg-black grid place-items-center"><span class="w-2.5 h-2.5 rounded-sm bg-[#C6F432]"></span></span>StokKu
  </a>
  <p class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight mt-10">Buat akun toko,<br>catat penjualan pertamamu.</p>
</div>
<div class="flex items-center justify-center p-8">
  <form method="post" action="/daftar" class="w-full max-w-sm">@csrf
    <h1 class="text-3xl font-extrabold mb-6">Daftar</h1>
    @foreach([['store_name','Nama toko','text'],['name','Nama kamu','text'],['email','Email','email'],['password','Kata sandi','password'],['password_confirmation','Ulangi kata sandi','password']] as [$n,$l,$t])
      <label class="block text-sm font-semibold mb-1.5">{{ $l }}</label>
      <input name="{{ $n }}" type="{{ $t }}" value="{{ $t === 'password' ? '' : old($n) }}" class="inp w-full mb-4" required>
    @endforeach
    @if($errors->any())<p class="text-sm text-red-700 mb-3">{{ $errors->first() }}</p>@endif
    <button class="btn w-full">Buat akun</button>
    <p class="text-sm text-black/60 mt-5">Sudah punya akun? <a href="/masuk" class="font-bold text-black underline">Masuk</a></p>
  </form>
</div>
</body>
</html>
