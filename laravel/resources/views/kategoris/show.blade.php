<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Detail Kategori</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $kategori->nama }}</h5>
                <p class="card-text">{{ $kategori->deskripsi }}</p>
                <p class="card-text"><strong>Jumlah Produk:</strong> {{ $kategori->produks->count() }}</p>
                <p class="card-text"><small class="text-muted">Dibuat pada: {{ $kategori->created_at }}</small></p>
            </div>
        </div>
        @if($kategori->produks->count() > 0)
            <h3 class="mt-4">Produk dalam Kategori Ini</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori->produks as $produk)
                            <tr>
                                <td>{{ $produk->nama }}</td>
                                <td>Rp{{ number_format($produk->harga_beli, 2, ',', '.') }}</td>
                                <td>Rp{{ number_format($produk->harga_jual, 2, ',', '.') }}</td>
                                <td>{{ $produk->stok }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <a href="{{ route('kategoris.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>
</html>