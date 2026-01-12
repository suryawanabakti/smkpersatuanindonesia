<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Formulir Pendaftaran - {{ $siswa->nama_lengkap }}</title>
    <style>
    body {
        font-family: 'Times New Roman', Times, serif;
        font-size: 11px;
        line-height: 1.3;
        color: #000;
        margin: 0;
        padding: 30px;
    }

    .header {
        text-align: center;
        border-bottom: 2px double #000;
        margin-bottom: 10px;
        padding-bottom: 6px;
    }

    .header h1 {
        margin: 0;
        font-size: 18px;
        text-transform: uppercase;
    }

    .header p {
        margin: 2px 0;
        font-size: 11px;
    }

    .title {
        text-align: center;
        margin-bottom: 15px;
    }

    .title h2 {
        font-size: 14px;
        margin: 0;
        text-decoration: underline;
    }

    .title p {
        margin: 2px 0 0;
        font-size: 11px;
    }

    .section-title {
        font-weight: bold;
        background: #eee;
        padding: 4px 8px;
        margin: 12px 0 6px 0;
        border: 1px solid #ccc;
        font-size: 11px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table td {
        padding: 3px 4px;
        vertical-align: top;
        font-size: 11px;
    }

    .label {
        width: 170px;
        white-space: nowrap;
    }

    .colon {
        width: 8px;
    }

    .footer {
        margin-top: 25px;
        display: flex;
        justify-content: flex-end;
    }

    .signature {
        text-align: center;
        width: 220px;
        font-size: 11px;
    }

    .signature-space {
        height: 55px;
    }

    @media print {
        body {
            padding: 15mm;
        }
        .no-print {
            display: none;
        }
    }
</style>

</head>
<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; background: #4f46e5; color: white; border: none; border-radius: 5px;">Cetak Sekarang</button>
        <a href="{{ route('student.formulir.edit') }}" style="padding: 10px 20px; text-decoration: none; background: #6b7280; color: white; border-radius: 5px; margin-left: 10px;">Kembali</a>
    </div>

    <div class="header">
        <h1>PEMERINTAH PROVINSI SULAWESI SELATAN <br> DINAS PENDIDIKAN <br> UPT SMK PERSATUAN INDONESIA MAROS </h1>
        <p>Alamat : Jl. Poros Kariango-Carangki,Desa Lekopancing, Kec. Tanralili, Kab. Maros</p>
        
    </div>

    <div class="title">
        <h2>FORMULIR PENDAFTARAN <br> CALON SISWA BARU TAHUN 2025/2026</h2>
    </div>

    <div class="section-title">A. DATA PRIBADI SISWA</div>
    <table>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td class="colon">:</td>
            <td>{{ $siswa->nama_lengkap }}</td>
        </tr>
        <tr>
            <td class="label">NISN</td>
            <td class="colon">:</td>
            <td>{{ $siswa->nisn }}</td>
        </tr>
        <tr>
            <td class="label">Tempat, Tanggal Lahir</td>
            <td class="colon">:</td>
            <td>{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Kelamin</td>
            <td class="colon">:</td>
            <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td class="label">Agama</td>
            <td class="colon">:</td>
            <td>{{ $siswa->agama }}</td>
        </tr>
        <tr>
            <td class="label">Asal Sekolah</td>
            <td class="colon">:</td>
            <td>{{ $siswa->asal_sekolah }}</td>
        </tr>
        <tr>
            <td class="label">Jurusan Pilihan</td>
            <td class="colon">:</td>
            <td>{{ $siswa->jurusan_pilihan }}</td>
        </tr>
        <tr>
            <td class="label">No. HP / WA</td>
            <td class="colon">:</td>
            <td>{{ $siswa->no_hp }}</td>
        </tr>
        <tr>
            <td class="label">Alamat Lengkap</td>
            <td class="colon">:</td>
            <td>{{ $siswa->alamat }}</td>
        </tr>
    </table>

    <div class="section-title">B. DATA ORANG TUA / WALI</div>
    <table>
        <tr>
            <td class="label">Nama Orang Tua / Wali</td>
            <td class="colon">:</td>
            <td>{{ $siswa->nama_wali }}</td>
        </tr>
        <tr>
            <td class="label">Pekerjaan</td>
            <td class="colon">:</td>
            <td>{{ $siswa->pekerjaan_wali }}</td>
        </tr>
        <tr>
            <td class="label">Penghasilan</td>
            <td class="colon">:</td>
            <td>{{ $siswa->penghasilan_wali }}</td>
        </tr>
        <tr>
            <td class="label">No. HP Orang Tua</td>
            <td class="colon">:</td>
            <td>{{ $siswa->no_hp_orang_tua }}</td>
        </tr>
        <tr>
            <td class="label">Alamat Orang Tua / Wali</td>
            <td class="colon">:</td>
            <td>{{ $siswa->alamat_wali }}</td>
        </tr>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Maros, {{ now()->format('d F Y') }}</p>
            <p>Calon Siswa,</p>
            <div class="signature-space"></div>
            <p><strong>( {{ $siswa->nama_lengkap }} )</strong></p>
        </div>
    </div>

    <script>
        window.onload = function() {
            // Optional: Auto trigger print
            // window.print();
        }
    </script>
</body>
</html>
