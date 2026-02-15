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
            margin-bottom: 5px;
        }

        .header table {
            width: 100%;
            border: none;
        }

        .header td {
            vertical-align: middle;
            border: none;
        }

        .header-text {
            text-align: center;
            line-height: 1.1;
        }

        .header-text h2 {
            margin: 0;
            font-size: 14px;
            font-weight: normal;
            text-transform: uppercase;
        }

        .header-text h1 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text p {
            margin: 2px 0 0;
            font-size: 10px;
            font-style: italic;
        }

        .line-double {
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            height: 2px;
            margin-top: 5px;
            margin-bottom: 10px;
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
        <table>
            <tr>
                <td width="15%" style="text-align: left;">
                    <img src="{{ asset('logo2.jpeg') }}" width="70" alt="Logo">
                </td>
                <td width="70%" class="header-text">
                    <h2>PEMERINTAH PROVINSI SULAWESI SELATAN</h2>
                    <h1>DINAS PENDIDIKAN</h1>
                    <h1>UPT SMK PERSATUAN INDONESIA MAROS</h1>
                    <p>Alamat: JL. Poros Kariango Kostrad, Maros Tlp. 0411 – 4815517. Kode Pos : 90553</p>
                    <p>Email: <span style="color: blue; text-decoration: underline;">marossmkpersatuan@gmail.com</span>,
                        NPSN : 40300216</p>
                </td>
                <td width="15%" style="text-align: right;">
                    <img src="{{ asset('logosulsel.jpeg') }}" width="70" alt="Logo">
                </td>
            </tr>
        </table>
        <div class="line-double"></div>
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
