<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Daftar Produk</h1>
        <div class="alert alert-info">
            <strong>Total Produk:</strong> {{ $produks->count() }}
        </div>
        @if($stokHampirHabis->count() > 0)
            <div class="alert alert-warning">
                <h5>⚠️ Stok Hampir Habis (≤ 5)</h5>
                <p>Ada {{ $stokHampirHabis->count() }} produk dengan stok rendah:</p>
                <ul>
                    @foreach($stokHampirHabis as $produk)
                        <li><strong>{{ $produk->nama }}</strong> - Stok: {{ $produk->stok }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <a href="{{ route('produks.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
        <a href="{{ route('stok.hampir.habis') }}" class="btn btn-warning mb-3 ms-2">⚠️ Stok Hampir Habis</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok Awal</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produks as $produk)
                    <tr class="{{ $produk->stok <= 5 ? 'table-warning' : '' }}">
                        <td>{{ $produk->id }}</td>
                        <td>{{ $produk->nama }}</td>
                        <td>{{ $produk->kategori ? $produk->kategori->nama : '-' }}</td>
                        <td>Rp{{ number_format($produk->harga_beli, 2, ',', '.') }}</td>
                        <td>Rp{{ number_format($produk->harga_jual, 2, ',', '.') }}</td>
                        <td>{{ $produk->stok_awal }}</td>
                        <td>
                            {{ $produk->stok }}
                            @if($produk->stok <= 5)
                                <span class="badge bg-danger ms-1">Hampir Habis</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('produks.show', $produk) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('produks.edit', $produk) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('produks.destroy', $produk) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>