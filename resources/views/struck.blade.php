<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pesanan</title>
    <link href="{{ public_path('css/tailwind-pdf.css') }}" rel="stylesheet" type="text/css">
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.4;
            margin: 20px;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <img src="{{ public_path('asset/img/logo 3.png') }}" alt="Logo" style="height: 50px; margin: 0 auto;">
        <h1 style="font-size: 16px; font-weight: bold; margin: 10px 0;">NOTA PEMBELIAN</h1>
        <div style="font-size: 11px;">
            Jl. Raya Bogor No.123, Bogor<br>
            Telp: (021) 123-4567
        </div>
    </div>

    <div class="divider"></div>

    <div style="margin-bottom: 10px; margin-right: -10px;">
        <table style="width: 100%; font-size: 11px; border-spacing: 0;">
            <tr>
                <td style="width: 80px; padding-right: 0;">No. Pesanan</td>
                <td style="width: 5px; padding: 0;">:</td>
                <td>{{ $order->id }}</td>
                <td style="text-align: right;">{{ now()->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td style="padding-right: 0;">Pelanggan</td>
                <td style="padding: 0;">:</td>
                <td colspan="2">{{ $order->customer->name }}</td>
            </tr>
            <tr>
                <td style="padding-right: 0;">Waktu</td>
                <td style="padding: 0;">:</td>
                <td colspan="2">{{ now()->format('H:i:s') }}</td>
            </tr>
        </table>
    </div>

    <div class="divider"></div>

    <table style="width: 100%; font-size: 11px;">
        @foreach($order->items as $item)
            <tr>
                <td colspan="4">{{ $item->product->name }}</td>
            </tr>
            <tr>
                <td>{{ $item->quantity }} x</td>
                <td style="text-align: right;">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                <td>=</td>
                <td style="text-align: right;">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <div class="divider"></div>

    <table style="width: 100%; font-size: 11px;">
        <tr>
            <td style="width: 50%;">TOTAL</td>
            <td style="text-align: right;">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>PEMBAYARAN</td>
            <td style="text-align: right;">{{ $order->paymentType->name }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <div class="text-center" style="font-size: 11px;">
        <p>Terima kasih atas kunjungan Anda</p>
        <p>Silahkan datang kembali</p>
    </div>
</body>
</html>
