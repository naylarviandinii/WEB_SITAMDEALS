<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }} - SiTamDeals</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; }
        .font-playfair { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="p-8">

    <div class="max-w-3xl mx-auto border border-gray-200 p-10 shadow-lg">
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-4xl font-playfair font-black text-[#050d09]">INVOICE</h1>
                <p class="text-gray-500">No Pesanan: #{{ $order->id }}</p>
            </div>
            <div class="text-right">
                <h2 class="text-xl font-bold">SiTamDeals</h2>
                <p class="text-sm text-gray-600">Kasir Ritel Tambah Jaya</p>
            </div>
        </div>

        <table class="w-full mb-10 border-t border-b border-gray-200">
            <thead>
                <tr class="text-left text-xs uppercase text-gray-500">
                    <th class="py-4">Produk</th>
                    <th class="py-4 text-right">Jumlah</th>
                    <th class="py-4 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @php $calculatedTotal = 0; @endphp
                @foreach($order->items as $item)
                @php 
                    // Pastikan variabel 'price' sesuai dengan nama kolom di database kamu
                    $subtotal = $item->price * $item->qty; 
                    $calculatedTotal += $subtotal; 
                @endphp
                <tr>
                    <td class="py-4">
                        <p class="font-bold">{{ $item->product->name }}</p>
                        <p class="text-xs text-gray-400">Grade {{ $item->grade }}</p>
                    </td>
                    <td class="py-4 text-right">{{ $item->qty }}</td>
                    <td class="py-4 text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right">
            <p class="text-sm text-gray-500">Total Pembayaran</p>
            <p class="text-3xl font-playfair font-black text-[#0A1A12]">
                Rp {{ number_format($calculatedTotal, 0, ',', '.') }}
            </p>
        </div>

        <div class="mt-16 pt-8 border-t border-gray-100 text-center text-gray-400 text-xs">
            <p>Terima kasih telah berbelanja di SiTamDeals.</p>
        </div>
    </div>

</body>
</html>