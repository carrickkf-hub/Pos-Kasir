<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Daftar Kategori</h1>
        <div class="alert alert-info">
            <strong>Total Kategori:</strong> {{ $kategoris->count() }} | <strong>Total Produk:</strong> {{ $totalProduk }}
        </div>
        @if($kategorisStokRendah->count() > 0)
            <div class="alert alert-warning">
                <h5>⚠️ Kategori dengan Stok Hampir Habis</h5>
                @foreach($kategorisStokRendah as $kategori)
                    <p><strong>{{ $kategori->nama }}</strong> memiliki {{ $kategori->produks->count() }} produk dengan stok ≤ 5</p>
                @endforeach
            </div>
        @endif
        <a href="{{ route('kategoris.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
        <a href="{{ route('stok.hampir.habis') }}" class="btn btn-warning mb-3 ms-2">⚠️ Stok Hampir Habis</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $kategori)
                    @php
                        $hasLowStock = $kategori->produks()->where('stok', '<=', 5)->exists();
                    @endphp
                    <tr class="{{ $hasLowStock ? 'table-warning' : '' }}">
                        <td>{{ $kategori->id }}</td>
                        <td>{{ $kategori->nama }}</td>
                        <td>{{ $kategori->deskripsi }}</td>
                        <td>
                            {{ $kategori->produks_count }}
                            @if($hasLowStock)
                                <span class="badge bg-danger ms-1">Stok Rendah</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('kategoris.show', $kategori) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('kategoris.edit', $kategori) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kategoris.destroy', $kategori) }}" method="POST" style="display:inline;">
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