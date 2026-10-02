@include('errors._box', ['code' => 403, 'title' => 'Tidak punya akses', 'text' => $exception->getMessage() ?: 'Halaman ini hanya untuk pemilik toko.'])
