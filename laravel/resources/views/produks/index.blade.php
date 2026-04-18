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
        <a href="{{ route('produks.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produks as $produk)
                    <tr>
                        <td>{{ $produk->id }}</td>
                        <td>{{ $produk->nama }}</td>
                        <td>Rp{{ number_format($produk->harga, 2, ',', '.') }}</td>
                        <td>{{ $produk->stok }}</td>
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