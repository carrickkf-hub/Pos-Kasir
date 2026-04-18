@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    💰 Input Pembayaran
                </h1>
                <a href="{{ route('produks.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                    ← Kembali ke Produk
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('transaksis.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="produk_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Pilih Produk
                    </label>
                    <select name="produk_id" id="produk_id" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($produks as $produk)
                            <option value="{{ $produk->id }}" data-harga="{{ $produk->harga_jual }}" data-stok="{{ $produk->stok }}">
                                {{ $produk->nama }} - Rp {{ number_format($produk->harga_jual, 0, ',', '.') }} (Stok: {{ $produk->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Jumlah
                    </label>
                    <input type="number" name="jumlah" id="jumlah" min="1" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <p id="stok-info" class="mt-1 text-sm text-gray-500 dark:text-gray-400"></p>
                </div>

                <div>
                    <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Metode Pembayaran
                    </label>
                    <select name="metode_pembayaran" id="metode_pembayaran" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">-- Pilih Metode --</option>
                        <option value="tunai">💵 Tunai</option>
                        <option value="kartu">💳 Kartu</option>
                        <option value="transfer">🏦 Transfer Bank</option>
                    </select>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Ringkasan Pembayaran</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">Harga Satuan:</span>
                            <span id="harga-satuan" class="font-medium">Rp 0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">Jumlah:</span>
                            <span id="jumlah-display" class="font-medium">0</span>
                        </div>
                        <hr class="border-gray-300 dark:border-gray-600">
                        <div class="flex justify-between text-lg font-bold">
                            <span class="text-gray-900 dark:text-white">Total:</span>
                            <span id="total-harga" class="text-green-600 dark:text-green-400">Rp 0</span>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                        ✅ Proses Pembayaran
                    </button>
                    <button type="reset" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                        🔄 Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const produkSelect = document.getElementById('produk_id');
    const jumlahInput = document.getElementById('jumlah');
    const hargaSatuanDisplay = document.getElementById('harga-satuan');
    const jumlahDisplay = document.getElementById('jumlah-display');
    const totalHargaDisplay = document.getElementById('total-harga');
    const stokInfo = document.getElementById('stok-info');

    let selectedHarga = 0;
    let selectedStok = 0;

    produkSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        selectedHarga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
        selectedStok = parseInt(selectedOption.getAttribute('data-stok')) || 0;

        hargaSatuanDisplay.textContent = 'Rp ' + selectedHarga.toLocaleString('id-ID');
        stokInfo.textContent = selectedStok > 0 ? `Stok tersedia: ${selectedStok}` : 'Stok habis';
        updateTotal();
    });

    jumlahInput.addEventListener('input', function() {
        updateTotal();
    });

    function updateTotal() {
        const jumlah = parseInt(jumlahInput.value) || 0;
        const total = selectedHarga * jumlah;

        jumlahDisplay.textContent = jumlah;
        totalHargaDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');

        // Validasi stok
        if (jumlah > selectedStok) {
            jumlahInput.setCustomValidity('Jumlah melebihi stok tersedia');
            stokInfo.textContent = `Stok tidak cukup! Tersedia: ${selectedStok}`;
            stokInfo.className = 'mt-1 text-sm text-red-500';
        } else {
            jumlahInput.setCustomValidity('');
            stokInfo.textContent = selectedStok > 0 ? `Stok tersedia: ${selectedStok}` : 'Stok habis';
            stokInfo.className = 'mt-1 text-sm text-gray-500 dark:text-gray-400';
        }
    }
});
</script>
@endsection