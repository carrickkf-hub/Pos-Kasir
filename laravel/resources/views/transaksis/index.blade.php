@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">Riwayat Transaksi</h1>
            <p class="text-muted">Daftar transaksi pembayaran yang berhasil disimpan.</p>
        </div>
        <a href="{{ route('transaksis.create') }}" class="btn btn-primary">+ Transaksi Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                            <th>Bayar</th>
                            <th>Kembalian</th>
                            <th>Metode</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $transaksi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaksi->produk->nama }}</td>
                                <td>{{ $transaksi->jumlah }}</td>
                                <td>Rp {{ number_format($transaksi->harga_satuan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($transaksi->metode_pembayaran) }}</td>
                                <td>{{ $transaksi->tanggal_transaksi->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">Belum ada transaksi tersimpan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection