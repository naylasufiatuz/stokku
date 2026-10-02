<!doctype html>
<html lang="id">
<head>@include('layouts.head')<title>StokKu - Catat stok dan penjualan UMKM</title>
<style>html{scroll-behavior:smooth}section[id]{scroll-margin-top:80px}details summary{list-style:none;cursor:pointer}details summary::-webkit-details-marker{display:none}details[open] .plus{transform:rotate(45deg)}</style>
</head>
<body>
@php $star = '<svg width="18" height="18" viewBox="0 0 24 24" fill="#C6F432"><path d="M12 0l3 9 9 3-9 3-3 9-3-9-9-3 9-3z"/></svg>'; @endphp

<header class="sticky top-0 z-50 bg-white/85 backdrop-blur border-b border-black/5">
  <div class="px-5 md:px-10 py-4 flex items-center max-w-6xl mx-auto">
    <a href="/" class="flex items-center gap-2 font-extrabold text-lg">
      <span class="w-7 h-7 rounded-lg bg-black grid place-items-center"><span class="w-2.5 h-2.5 rounded-sm bg-[#C6F432]"></span></span>StokKu
    </a>
    <nav class="hidden md:flex gap-8 text-sm font-medium mx-auto text-black/70">
      <a href="#masalah" class="hover:text-black">Masalah</a><a href="#fitur" class="hover:text-black">Fitur</a>
      <a href="#cara" class="hover:text-black">Cara kerja</a><a href="#cocok" class="hover:text-black">Cocok untuk</a><a href="#faq" class="hover:text-black">Tanya jawab</a>
    </nav>
    <div class="ml-auto md:ml-0 flex items-center gap-4">@guest<a href="/masuk" class="text-sm font-semibold">Masuk</a>@endguest<a href="{{ auth()->check() ? '/ringkasan' : '/daftar' }}" class="btn">{{ auth()->check() ? 'Buka aplikasi' : 'Daftar' }}</a></div>
  </div>
</header>

{{-- HERO --}}
<section class="px-5 md:px-10 pt-14 pb-16 max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
  <div>
    <div class="flex flex-wrap gap-2 mb-6 text-sm font-semibold">
      @foreach(['Catat stok', 'Catat penjualan', 'Prediksi mingguan', 'Bisa lewat HP'] as $c)
        <span class="rounded-full bg-black/5 px-3.5 py-1.5">{{ $c }}</span>
      @endforeach
    </div>
    <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight leading-[1.02]">Stok warung aman, untung makin kelihatan.</h1>
    <p class="mt-6 text-lg text-black/60 max-w-md">Catat barang dan penjualan harian, lihat mana yang paling laku, dan tahu kapan harus kulakan sebelum stok habis.</p>
    <div class="mt-8 flex flex-wrap gap-3">
      <a href="/daftar" class="btn !px-7 !py-3.5 !text-base">Mulai pakai</a>
      <a href="#cara" class="inline-flex items-center rounded-full border border-black/20 px-7 py-3.5 font-semibold hover:bg-black/5">Lihat cara kerja</a>
    </div>
    <div class="mt-12 flex gap-10">
      <div><p class="text-3xl font-extrabold">7 hari</p><p class="text-sm text-black/60">prediksi ke depan</p></div>
      <div><p class="text-3xl font-extrabold">30 hari</p><p class="text-sm text-black/60">grafik penjualan</p></div>
      <div><p class="text-3xl font-extrabold">2 peran</p><p class="text-sm text-black/60">pemilik &amp; karyawan</p></div>
    </div>
  </div>
  <div class="relative">
    <div class="bg-[#C6F432] rounded-3xl p-7 rotate-2">
      <p class="font-semibold">Stok gula</p><p class="text-6xl font-extrabold mt-1">2 hari</p><p class="text-sm mt-1">Waktunya kulakan</p>
    </div>
    <div class="bg-black text-white rounded-3xl p-7 mt-4 md:ml-12 -rotate-1">
      <p class="text-sm text-white/60">Penjualan minggu ini</p>
      <div class="flex items-end gap-2 h-28 mt-4">
        @foreach([35, 50, 42, 60, 55, 85, 100] as $h)<div class="flex-1 rounded-full bg-[#C6F432]" style="height:{{ $h }}%"></div>@endforeach
      </div>
    </div>
  </div>
</section>

{{-- MARQUEE --}}
<div class="bg-black text-white py-5 overflow-hidden">
  <div class="mq flex gap-10 text-xl font-bold whitespace-nowrap">
    @for($r = 0; $r < 2; $r++)
      @foreach(['Warung kopi', 'Toko kelontong', 'Katering rumahan', 'Toko kue', 'Kios pulsa', 'Laundry', 'Toko bangunan'] as $n)
        <span class="flex items-center gap-10">{{ $n }}{!! $star !!}</span>
      @endforeach
    @endfor
  </div>
</div>

{{-- MASALAH --}}
<section id="masalah" class="px-5 md:px-10 py-24 max-w-6xl mx-auto">
  <p class="text-sm font-bold uppercase tracking-widest text-black/50">Masalah sehari-hari</p>
  <h2 class="text-4xl md:text-6xl font-extrabold tracking-tight max-w-3xl mt-3">Masih catat di buku, atau cuma diingat-ingat?</h2>
  <div class="grid md:grid-cols-3 gap-4 mt-12">
    @foreach([
      ['Stok habis pas lagi ramai', 'Pembeli datang, barangnya kosong. Rugi dua kali: kehilangan penjualan dan pelanggan.'],
      ['Tidak tahu mana yang untung', 'Semua barang terasa laku, padahal ada yang cuma menuh-menuhin rak.'],
      ['Rekap akhir bulan bikin pusing', 'Nota menumpuk, hitungan tidak ketemu, dan akhirnya cuma kira-kira.'],
    ] as $i => [$t, $d])
      <div class="rounded-3xl {{ $i == 1 ? 'bg-black text-white' : 'bg-black/5' }} p-8">
        <span class="inline-grid place-items-center w-10 h-10 rounded-full bg-[#C6F432] text-black font-extrabold">{{ $i + 1 }}</span>
        <h3 class="text-2xl font-extrabold mt-8">{{ $t }}</h3>
        <p class="mt-3 opacity-70">{{ $d }}</p>
      </div>
    @endforeach
  </div>
</section>

{{-- FITUR (bento) --}}
<section id="fitur" class="px-5 md:px-10 pb-24 max-w-6xl mx-auto">
  <p class="text-sm font-bold uppercase tracking-widest text-black/50">Fitur</p>
  <h2 class="text-4xl md:text-6xl font-extrabold tracking-tight max-w-3xl mt-3">Semua yang dibutuhkan toko kecil, tanpa ribet.</h2>
  <div class="grid md:grid-cols-3 gap-4 mt-12">
    <div class="md:col-span-2 bg-[#C6F432] rounded-3xl p-8 min-h-[280px] flex flex-col justify-between">
      <div><h3 class="text-3xl font-extrabold">Prediksi 7 hari</h3>
        <p class="mt-2 max-w-sm opacity-80">Dari penjualan beberapa minggu terakhir, StokKu memperkirakan barang apa yang bakal laku dan berapa hari stok masih cukup.</p></div>
      <div class="flex items-end gap-2 h-24 mt-6">
        @foreach([30, 45, 40, 55, 50, 70, 65, 80, 75, 95] as $h)<div class="flex-1 rounded-full bg-black" style="height:{{ $h }}%"></div>@endforeach
      </div>
    </div>
    <div class="bg-black text-white rounded-3xl p-8 min-h-[280px]">
      <h3 class="text-2xl font-extrabold">Peringatan stok</h3>
      <ul class="mt-6 space-y-3 text-sm">
        @foreach([['Telur 1 kg', '1 hari'], ['Gula 1 kg', '2 hari'], ['Roti coklat', '4 hari']] as [$n, $d])
          <li class="flex justify-between border-b border-white/15 pb-3"><span>{{ $n }}</span><span class="font-bold text-[#C6F432]">{{ $d }}</span></li>
        @endforeach
      </ul>
    </div>
    <div class="card p-8"><h3 class="text-2xl font-extrabold">Catat penjualan</h3>
      <p class="mt-3 text-black/60">Pilih barang, isi jumlah, selesai. Stok berkurang sendiri dan tidak bisa kejual melebihi stok.</p></div>
    <div class="card p-8"><h3 class="text-2xl font-extrabold">Pemilik &amp; karyawan</h3>
      <p class="mt-3 text-black/60">Karyawan bisa mencatat dan melihat stok. Tambah atau hapus barang tetap hak pemilik.</p></div>
    <div class="card p-8"><h3 class="text-2xl font-extrabold">Unduh ke CSV</h3>
      <p class="mt-3 text-black/60">Butuh rekap? Unduh riwayat penjualan dan buka di Excel atau Google Sheets.</p></div>
  </div>
</section>

{{-- CARA KERJA --}}
<section id="cara" class="bg-black text-white">
  <div class="px-5 md:px-10 py-24 max-w-6xl mx-auto">
    <p class="text-sm font-bold uppercase tracking-widest text-white/50">Cara kerja</p>
    <h2 class="text-4xl md:text-6xl font-extrabold tracking-tight max-w-3xl mt-3">Tiga langkah, mulai hari ini.</h2>
    <div class="grid md:grid-cols-3 gap-10 mt-14">
      @foreach([
        ['Masukkan barang', 'Isi nama, harga, stok, dan batas minimum. Cukup sekali di awal.'],
        ['Catat penjualan', 'Setiap ada yang beli, catat. Butuh beberapa detik saja.'],
        ['Baca ringkasan', 'Lihat grafik, prediksi, dan peringatan stok. Kulakan jadi tidak menebak-nebak.'],
      ] as $i => [$t, $d])
        <div>
          <p class="text-8xl font-extrabold text-[#C6F432] leading-none">{{ $i + 1 }}</p>
          <h3 class="text-2xl font-extrabold mt-6">{{ $t }}</h3>
          <p class="mt-3 text-white/60">{{ $d }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- PREVIEW --}}
<section class="px-5 md:px-10 py-24 max-w-6xl mx-auto">
  <p class="text-sm font-bold uppercase tracking-widest text-black/50">Contoh tampilan</p>
  <h2 class="text-4xl md:text-6xl font-extrabold tracking-tight max-w-3xl mt-3">Sekali lihat, langsung paham.</h2>
  <div class="mt-12 rounded-3xl border border-black/10 overflow-hidden shadow-[0_20px_60px_-30px_rgba(0,0,0,.35)]">
    <div class="flex gap-1.5 px-5 py-3 bg-black/5">@for($d = 0; $d < 3; $d++)<span class="w-3 h-3 rounded-full bg-black/20"></span>@endfor</div>
    <div class="p-5 md:p-8 grid md:grid-cols-3 gap-4">
      <div class="rounded-2xl bg-[#C6F432] p-5"><p class="text-sm font-semibold">Penjualan hari ini</p><p class="text-3xl font-extrabold mt-2">Rp 1.240.000</p></div>
      <div class="rounded-2xl bg-black text-white p-5"><p class="text-sm text-white/60 font-semibold">Stok menipis</p><p class="text-3xl font-extrabold mt-2">3 barang</p></div>
      <div class="rounded-2xl bg-black/5 p-5"><p class="text-sm font-semibold">Minggu ini</p><p class="text-sm mt-2">Kopi susu naik 20%. Stok gula cukup 2 hari.</p></div>
      <div class="md:col-span-3 rounded-2xl border border-black/10 p-5">
        <div class="flex items-end gap-1.5 h-32">
          @foreach([40, 55, 48, 62, 58, 80, 90, 52, 60, 56, 68, 64, 85, 95, 58, 62, 60, 70, 66, 88, 98, 60, 64, 62, 72, 70, 90, 100] as $h)
            <div class="flex-1 rounded-full bg-black/80" style="height:{{ $h }}%"></div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- COCOK UNTUK --}}
<section id="cocok" class="px-5 md:px-10 pb-24 max-w-6xl mx-auto">
  <p class="text-sm font-bold uppercase tracking-widest text-black/50">Cocok untuk</p>
  <h2 class="text-4xl md:text-6xl font-extrabold tracking-tight max-w-3xl mt-3">Usaha kecil yang jualan tiap hari.</h2>
  <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 mt-12">
    @foreach([
      ['Warung kopi', 'Pantau susu, gula, dan kopi yang cepat habis.'],
      ['Toko kelontong', 'Ratusan barang kecil tetap terkontrol.'],
      ['Katering rumahan', 'Tahu bahan apa yang perlu dibeli minggu ini.'],
      ['Toko kue', 'Lihat kue yang laris dan yang sering sisa.'],
      ['Kios pulsa', 'Catat penjualan harian dengan rapi.'],
      ['Toko bangunan', 'Stok paku, cat, dan semen tidak kosong tiba-tiba.'],
    ] as $i => [$t, $d])
      <div class="rounded-3xl p-6 border border-black/10 hover:bg-[#C6F432] transition">
        <h3 class="text-xl font-extrabold">{{ $t }}</h3><p class="mt-2 text-sm text-black/60">{{ $d }}</p>
      </div>
    @endforeach
  </div>
</section>

{{-- FAQ --}}
<section id="faq" class="px-5 md:px-10 pb-24 max-w-3xl mx-auto">
  <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight">Pertanyaan yang sering muncul</h2>
  <div class="mt-10 divide-y divide-black/10 border-y border-black/10">
    @foreach([
      ['Bisa dipakai lewat HP?', 'Bisa. StokKu berupa website, jadi cukup dibuka lewat browser di HP atau laptop.'],
      ['Seberapa akurat prediksinya?', 'Prediksi dihitung dari rata-rata penjualan terbaru, jadi sifatnya perkiraan. Makin rutin kamu mencatat, makin masuk akal hasilnya.'],
      ['Karyawan bisa lihat semuanya?', 'Karyawan bisa mencatat penjualan dan melihat stok. Menambah atau menghapus barang hanya bisa dilakukan pemilik.'],
      ['Kalau layanan prediksi mati?', 'Pencatatan stok dan penjualan tetap jalan. Hanya bagian prediksi yang menampilkan pesan bahwa belum bisa dimuat.'],
    ] as [$q, $a])
      <details class="py-5">
        <summary class="flex justify-between items-center gap-4 text-lg font-bold">{{ $q }}<span class="plus text-2xl transition">+</span></summary>
        <p class="mt-3 text-black/60">{{ $a }}</p>
      </details>
    @endforeach
  </div>
</section>

{{-- CTA --}}
<section class="px-5 md:px-10 pb-20 max-w-6xl mx-auto">
  <div class="bg-[#C6F432] rounded-3xl p-10 md:p-16 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <p class="text-3xl md:text-5xl font-extrabold tracking-tight max-w-xl">Coba catat penjualan hari ini.</p>
    <a href="/daftar" class="btn !px-8 !py-4 !text-base">Buat akun toko</a>
  </div>
</section>

<footer class="border-t border-black/10">
  <div class="px-5 md:px-10 py-10 max-w-6xl mx-auto flex flex-col md:flex-row justify-between gap-6 text-sm">
    <div><p class="font-extrabold text-lg">StokKu</p><p class="text-black/50 mt-1 max-w-xs">Catat stok dan penjualan untuk UMKM.</p></div>
    <div class="flex gap-10 text-black/60">
      <div class="space-y-2"><a href="#masalah" class="block hover:text-black">Masalah</a><a href="#fitur" class="block hover:text-black">Fitur</a><a href="#cara" class="block hover:text-black">Cara kerja</a></div>
      <div class="space-y-2"><a href="#cocok" class="block hover:text-black">Cocok untuk</a><a href="#faq" class="block hover:text-black">Tanya jawab</a><a href="/masuk" class="block hover:text-black">Masuk</a></div>
    </div>
  </div>
</footer>
</body>
</html>
