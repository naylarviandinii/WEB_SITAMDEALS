<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }} - SiTamDeals</title>
    <style>
        /* Menggunakan font standar sistem yang didukung penuh DomPDF */
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            color: #333333; 
            background-color: #ffffff;
            margin: 0;
            padding: 10px;
            font-size: 14px;
        }
        
        .invoice-container {
            max-width: 650px;
            margin: 0 auto;
            border: 1px solid #e5e7eb;
            padding: 30px;
        }

        /* STRUKTUR LAYOUT UTAMA: Wajib pakai tabel biasa agar kiri-kanan rapi */
        .layout-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
            margin-bottom: 30px;
        }
        .layout-table td {
            border: none;
            padding: 0;
            vertical-align: top;
        }

        /* Bagian Kiri & Kanan Header */
        .title {
            font-size: 30px;
            font-weight: bold;
            color: #050d09;
            margin: 0;
            letter-spacing: 1px;
        }
        .order-no {
            color: #6b7280;
            margin: 5px 0 0 0;
            font-size: 13px;
        }
        .brand-name {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
            color: #050d09;
        }
        .brand-sub {
            font-size: 12px;
            color: #4b5563;
            margin: 5px 0 0 0;
        }

        /* Tabel Detail Item Belanjaan */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 30px;
        }
        .items-table th {
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            color: #6b7280;
            padding: 12px 0;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
        }
        .items-table td {
            padding: 14px 0;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        .product-name {
            font-weight: bold;
            color: #050d09;
            margin: 0;
            font-size: 14px;
        }
        .product-grade {
            font-size: 11px;
            color: #9ca3af;
            margin: 3px 0 0 0;
        }

        /* Kelas Pembantu Alignment */
        .text-right {
            text-align: right;
        }

        /* Bagian Bawah / Total Pembayaran */
        .total-label {
            font-size: 12px;
            color: #6b7280;
            margin: 0;
        }
        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: #0A1A12;
            margin: 3px 0 0 0;
        }

        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
            text-align: center;
            color: #9ca3af;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        
        <table class="layout-table">
            <tr>
                <td>
                    <h1 class="title">INVOICE</h1>
                    <p class="order-no">No Pesanan: #{{ $order->id }}</p>
                </td>
                <td class="text-right">
                    <h2 class="brand-name">SiTamDeals</h2>
                    <p class="brand-sub">Kasir Ritel Tambah Jaya</p>
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Produk</th>
                    <th class="text-right" style="width: 20%;">Jumlah</th>
                    <th class="text-right" style="width: 30%;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                @php 
                    $subtotal = $item->price * $item->qty; 
                @endphp
                <tr>
                    <td>
                        <p class="product-name">{{ $item->product->name }}</p>
                        <p class="product-grade">Grade {{ $item->grade }}</p>
                    </td>
                    <td class="text-right" style="color: #050d09;">{{ $item->qty }}</td>
                    <td class="text-right" style="font-weight: bold; color: #050d09;">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="layout-table" style="margin-bottom: 0;">
            <tr>
                <td></td>
                <td class="text-right" style="width: 50%;">
                    <p class="total-label">Total Pembayaran</p>
                    <p class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</p>
                </td>
            </tr>
        </table>

        <div class="footer">
            <p>Terima kasih telah berbelanja di SiTamDeals.</p>
        </div>
    </div>

</body>
</html>