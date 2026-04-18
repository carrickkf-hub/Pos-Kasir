<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Hampir Habis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>⚠️ Stok Hampir Habis</h1>
        <p class="lead">Produk dengan stok ≤ 5 unit</p>

        @if($stokHampirHabis->count() > 0)
            <div class="alert alert-warning">
                <strong>Ditemukan {{ $stokHampirHabis->count() }} produk dengan stok rendah</strong>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga Jual</th>
                            <th>Stok Saat Ini</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stokHampirHabis as $produk)
                            <tr class="table-warning">
                                <td>{{ $produk->id }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->kategori ? $produk->kategori->nama : '-' }}</td>
                                <td>Rp{{ number_format($produk->harga_jual, 2, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-danger fs-6">{{ $produk->stok }}</span>
                                </td>
                                <td>
                                    @if($produk->stok == 0)
                                        <span class="badge bg-dark">Habis</span>
                                    @elseif($produk->stok <= 2)
                                        <span class="badge bg-danger">Kritis</span>
                                    @else
                                        <span class="badge bg-warning">Rendah</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('produks.edit', $produk) }}" class="btn btn-primary btn-sm">Update Stok</a>
                                    <a href="{{ route('produks.show', $produk) }}" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-success">
                <strong>✅ Semua produk memiliki stok yang cukup!</strong>
                <p>Tidak ada produk dengan stok ≤ 5 unit.</p>
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('produks.index') }}" class="btn btn-secondary">← Kembali ke Daftar Produk</a>
            <a href="{{ route('produks.create') }}" class="btn btn-success">+ Tambah Produk Baru</a>
        </div>
    </div>
</body>
</html>