<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function create()
    {
        $produks = Produk::where('stok', '>', 0)->get();
        return view('transaksis.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:tunai,kartu,transfer'
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        // Cek stok cukup
        if ($produk->stok < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok tidak cukup. Stok tersedia: ' . $produk->stok]);
        }

        $totalHarga = $produk->harga_jual * $request->jumlah;

        DB::transaction(function () use ($request, $produk, $totalHarga) {
            // Buat transaksi
            Transaksi::create([
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $produk->harga_jual,
                'total_harga' => $totalHarga,
                'metode_pembayaran' => $request->metode_pembayaran,
                'tanggal_transaksi' => now()
            ]);

            // Kurangi stok produk
            $produk->decrement('stok', $request->jumlah);
        });

        return redirect()->route('transaksis.create')->with('success', 'Pembayaran berhasil! Total: Rp ' . number_format($totalHarga, 0, ',', '.'));
    }
}
