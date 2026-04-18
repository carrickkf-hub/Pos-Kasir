<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Detail Produk</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $produk->nama }}</h5>
                <p class="card-text"><strong>Kategori:</strong> {{ $produk->kategori ? $produk->kategori->nama : 'Tidak ada' }}</p>
                <p class="card-text">{{ $produk->deskripsi }}</p>
                <p class="card-text"><strong>Harga Beli:</strong> Rp{{ number_format($produk->harga_beli, 2, ',', '.') }}</p>
                <p class="card-text"><strong>Harga Jual:</strong> Rp{{ number_format($produk->harga_jual, 2, ',', '.') }}</p>
                <p class="card-text"><strong>Stok Awal:</strong> {{ $produk->stok_awal }}</p>
                <p class="card-text"><strong>Stok Saat Ini:</strong> {{ $produk->stok }}</p>
                <p class="card-text"><small class="text-muted">Dibuat pada: {{ $produk->created_at }}</small></p>
            </div>
        </div>
        <a href="{{ route('produks.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>
</html>