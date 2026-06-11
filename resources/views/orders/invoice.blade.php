<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }} - SiTamDeals</title>
    <style>
        /* Mengatur halaman dasar kertas A4 */
        @page {
            size: a4;
            margin: 0; /* Margin nol agar kita bisa kontrol padding bodi secara penuh */
        }
        
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            color: #333333; 
            background-color: #ffffff;
            margin: 0;
            padding: 40px; /* Jarak dari tepi kertas */
        }
        
        /* Tabel Utama pembungkus Card agar posisi border kokoh di DomPDF */
        .invoice-card {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e5e7eb;
        }

        .card-body {
            padding: 40px;
        }

        /* Layout untuk baris horizontal */
        .layout-table {
            width: 100%;
            border-collapse: collapse;
        }
        .layout-table td {
            border: none;
            padding: 0;
            vertical-align: top;
        }

        /* Detail Komponen Atas */
        .title {
            font-size: 34px;
            font-family: 'Georgia', serif; /* Alternatif Playfair Display yang didukung DomPDF */
            font-weight: bold;
            color: #050d09;
            margin: 0;
            line-height: 1;
        }
        .order-no {
            color: #6b7280;
            margin: 8px 0 0 0;
            font-size: 14px;
        }
        .brand-name {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
            color: #050d09;
        }
        .brand-sub {
            font-size: 13px;
            color: #4b5563;
            margin: 6px 0 0 0;
        }

        /* Tabel Produk */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .items-table th {
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            color: #6b7280;
            padding: 16px 0;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            letter-spacing: 0.5px;
        }
        .items-table td {
            padding: 18px 0;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: top;
        }
        .product-name {
            font-weight: bold;
            color: #050d09;
            margin: 0;
            font-size: 15px;
        }
        .product-grade {
            font-size: 12px;
            color: #9ca3af;
            margin: 4px 0 0 0;
        }

        .text-right {
            text-align: right;
        }

        /* Bagian Total Bawah */
        .total-label {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
        }
        .total-amount {
            font-size: 28px;
            font-family: 'Georgia', serif;
            font-weight: bold;
            color: #0A1A12;
            margin: 5px 0 0 0;
        }

        .footer {
            margin-top: 60px;
            padding-top: 24px;
            border-top: 1px solid #f3f4f6;
            text-align: center;
            color: #9ca3af;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <table class="invoice-card">
        <tr>
            <td class="card-body">
                
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
                            <th class="text-left" style="width: 20%;">Jumlah</th>
                            <th class="text-left" style="width: 30%;">Subtotal</th>
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
                            <td class="text-left" style="color: #050d09; padding-left: 5px;">{{ $item->qty }}</td>
                            <td class="text-left" style="font-weight: bold; color: #050d09;">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <table class="layout-table">
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

            </td>
        </tr>
    </table>
<script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>