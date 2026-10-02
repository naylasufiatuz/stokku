@extends('layouts.app')
@section('c')
<h1 class="h1 mb-8">Ringkasan</h1>
@if($itemCount == 0 || $saleCount == 0)
<div class="card p-7 mb-4">
  <p class="font-extrabold text-xl mb-4">Mulai dari sini</p>
  <ol class="space-y-3 text-sm">
    @foreach([['Tambah barang pertamamu', '/barang', $itemCount > 0], ['Catat penjualan pertama', '/penjualan', $saleCount > 0], ['Tunggu beberapa hari, prediksi akan muncul di halaman ini', null, false]] as $i => [$t, $u, $ok])
      <li class="flex items-center gap-3"><span class="w-7 h-7 rounded-full grid place-items-center font-bold text-xs {{ $ok ? 'bg-[#C6F432]' : 'border border-black/20' }}">{{ $ok ? 'v' : $i + 1 }}</span>
        @if($u && !$ok)<a href="{{ $u }}" class="font-semibold underline">{{ $t }}</a>@else<span class="{{ $ok ? 'line-through text-black/40' : '' }}">{{ $t }}</span>@endif</li>
    @endforeach
  </ol>
</div>
@endif
<div class="grid md:grid-cols-2 gap-4 mb-4">
  <div class="rounded-3xl bg-[#C6F432] p-7">
    <p class="font-semibold">Penjualan hari ini</p>
    <p class="text-4xl md:text-5xl font-extrabold mt-3">Rp {{ number_format($today, 0, ',', '.') }}</p>
  </div>
  <div class="rounded-3xl bg-black text-white p-7">
    <p class="font-semibold text-white/70">Stok menipis</p>
    <p class="text-4xl md:text-5xl font-extrabold mt-3">{{ $low->count() }} barang</p>
    <p class="text-sm text-white/60 mt-2">{{ $low->pluck('name')->take(4)->join(', ') }}</p>
  </div>
</div>

<div class="grid md:grid-cols-3 gap-4 mb-4">
  <div class="card p-6 md:col-span-2">
    <p class="font-bold mb-3">Penjualan 30 hari terakhir</p>
    <canvas id="c" height="110"></canvas>
  </div>
  <div class="card p-6">
    <p class="font-bold mb-3">Minggu ini</p>
    @if($pred === null)
      <p class="text-sm text-black/60">Prediksi belum bisa dimuat. Pastikan layanan AI sudah dijalankan.</p>
    @elseif(count($notes))
      <ul class="text-sm space-y-3">@foreach($notes as $n)
        <li class="flex gap-2"><span class="mt-1.5 w-2 h-2 rounded-full bg-[#C6F432] border border-black shrink-0"></span>{{ $n }}</li>
      @endforeach</ul>
    @else
      <p class="text-sm text-black/60">{{ $days < 3 ? 'Prediksi mulai muncul setelah penjualan tercatat beberapa hari.' : 'Belum ada yang perlu diperhatikan.' }}</p>
    @endif
  </div>
</div>

@if($pred && $saleCount > 0)
<div class="card overflow-x-auto">
  <p class="font-bold p-6 pb-2">Prediksi 7 hari ke depan</p>
  <table class="w-full text-sm">
    <thead class="text-left text-black/50"><tr class="border-b border-black/10">
      <th class="px-6 py-3 font-semibold">Barang</th><th class="px-6 py-3 font-semibold">Tren</th>
      <th class="px-6 py-3 font-semibold">Perkiraan terjual</th><th class="px-6 py-3 font-semibold">Stok cukup</th></tr></thead>
    <tbody>@foreach($pred as $p)
      <tr class="border-b border-black/5 last:border-0">
        <td class="px-6 py-3 font-medium">{{ $p['name'] }}</td>
        <td class="px-6 py-3"><span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $p['trend'] === 'naik' ? 'bg-[#C6F432]' : ($p['trend'] === 'turun' ? 'bg-black text-white' : 'bg-black/5') }}">{{ $p['trend'] }}{{ $p['change_pct'] ? ' ' . ($p['change_pct'] > 0 ? '+' : '') . $p['change_pct'] . '%' : '' }}</span></td>
        <td class="px-6 py-3">{{ $p['next_7_days'] }}</td>
        <td class="px-6 py-3 {{ ($p['days_left'] !== null && $p['days_left'] <= 3) ? 'font-bold' : '' }}">{{ $p['days_left'] !== null ? $p['days_left'] . ' hari' : '-' }}</td>
      </tr>@endforeach</tbody>
  </table>
</div>
@endif

<script>
new Chart(document.getElementById('c'), {
  type: 'line',
  data: { labels: @json(array_keys($perDay)), datasets: [{ data: @json(array_values($perDay)), borderColor: '#0b0b0b', backgroundColor: 'rgba(198,244,50,.45)', fill: true, borderWidth: 2, pointRadius: 0, tension: .35 }] },
  options: { animation: false, plugins: { legend: { display: false } },
    scales: { x: { grid: { display: false }, ticks: { maxTicksLimit: 6 } }, y: { grid: { color: 'rgba(0,0,0,.06)' } } } }
});
</script>
@endsection
