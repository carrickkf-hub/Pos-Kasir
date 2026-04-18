<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->get();
        return view('produks.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('produks.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|gte:harga_beli',
            'stok_awal' => 'required|integer|min:0',
            'kategori_id' => 'nullable|exists:kategoris,id',
        ], [
            'harga_jual.gte' => 'Harga jual harus lebih besar atau sama dengan harga beli.',
        ]);

        Produk::create(array_merge($request->only(['nama', 'deskripsi', 'harga_beli', 'harga_jual', 'stok_awal', 'kategori_id']), ['stok' => $request->input('stok_awal')]));

        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        $produk->load('kategori');
        return view('produks.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        return view('produks.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|gte:harga_beli',
            'stok' => 'required|integer|min:0',
            'stok_awal' => 'required|integer|min:0',
            'kategori_id' => 'nullable|exists:kategoris,id',
        ], [
            'harga_jual.gte' => 'Harga jual harus lebih besar atau sama dengan harga beli.',
        ]);

        $produk->update($request->only(['nama', 'deskripsi', 'harga_beli', 'harga_jual', 'stok', 'stok_awal', 'kategori_id']));

        return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');
    }
}