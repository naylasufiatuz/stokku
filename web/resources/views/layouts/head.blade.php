<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;color:#0b0b0b;background:#fff}
@keyframes mq{to{transform:translateX(-50%)}}
.mq{animation:mq 28s linear infinite;width:max-content}
</style>
<style type="text/tailwindcss">
@layer components{
 .btn{@apply inline-flex items-center justify-center rounded-full bg-[#0b0b0b] text-white px-5 py-2.5 text-sm font-semibold transition hover:bg-[#C6F432] hover:text-black}
 .btn-lime{@apply inline-flex items-center justify-center rounded-full bg-[#C6F432] text-black px-5 py-2.5 text-sm font-semibold transition hover:bg-black hover:text-white}
 .inp{@apply border border-black/15 rounded-full px-4 py-2.5 bg-white text-sm focus:outline-none focus:border-black}
 .card{@apply bg-white border border-black/10 rounded-3xl}
 .h1{@apply text-4xl md:text-5xl font-extrabold tracking-tight}
}
</style>
