<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran - {{ $payment->order_id }}</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .address {
            font-size: 14px;
        }
        .receipt-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
            text-transform: uppercase;
        }
        .details {
            margin-bottom: 20px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
        }
        .total {
            border-top: 1px dashed #333;
            border-bottom: 1px dashed #333;
            padding: 10px 0;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 40px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
        .btn-print {
            background: #333;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: right;">
        <button onclick="window.print()" class="btn-print">Cetak</button>
    </div>

    <div class="header">
        <div class="logo">SMK Persatuan Indonesia Maros</div>
        <div class="address">Jl. Poros kariango-carangki</div>
        <div class="address">Telp: (021) 12345678 | Email: info@sekolah.sch.id</div>
    </div>

    <div class="receipt-title">Bukti Pembayaran</div>

    <div class="details">
        <div class="row">
            <span class="label">No. Referensi:</span>
            <span>{{ $payment->order_id }}</span>
        </div>
        <div class="row">
            <span class="label">Tanggal:</span>
            <span>{{ $payment->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="row">
            <span class="label">Siswa:</span>
            <span>{{ $payment->user->name }}</span>
        </div>
        <!-- Assuming there's a way to get class/NIS, otherwise omit -->
        
        <div class="row">
            <span class="label">Keterangan:</span>
            <span>{{ $payment->description }}</span>
        </div>
        <div class="row">
            <span class="label">Metode Pembayaran:</span>
            <span>Online Payment (Midtrans)</span>
        </div>
        <div class="row">
            <span class="label">Status:</span>
            <span style="text-transform: uppercase;">{{ $payment->status }}</span>
        </div>
    </div>

    <div class="total row">
        <span>Total Bayar:</span>
        <span>Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
    </div>

    <div class="footer">
        <p>Terima kasih atas pembayaran Anda.</p>
        <p>Bukti pembayaran ini sah dan diterbitkan secara komputerisasi.</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
