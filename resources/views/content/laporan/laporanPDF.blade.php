<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Surat - {{ $namaBulanIndonesia }} {{ $tahun }}</title>
    <style>
        @page {
            size: A4 landscape; /* Mengubah ukuran menjadi landscape */
            margin: 20px;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        .company-address {
            margin: 5px 0;
        }
        .summary {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            text-align: center;
        }
        .summary-box {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            width: 45%;
        }
        .summary-box h2 {
            margin-top: 0;
        }
        .report-title {
            text-align: center;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .signature {
            margin-top: 50px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="company-name">SISTEM PENGARSIPAN SURAT</h1>
        <p class="company-address">Kalurahan Karangrejek, Kapanewon Wonosari</p>
    </div>

    <div class="report-title">
        <h2>LAPORAN SURAT MASUK & KELUAR</h2>
        <p>Periode: {{ $namaBulanIndonesia }} {{ $tahun }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Arsip</th>
                <th>Tanggal Surat</th>
                <th>No. Surat</th>
                <th>Perihal Surat</th>
                <th>Jenis Surat</th>
                <th>Penanggung Jawab</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataSurat as $index => $surat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $surat->kode_arsip }} [{{ $surat->klasifikasi_arsip->nama_arsip }}]</td>
                    <td>{{ date('d/m/Y', strtotime($surat->tgl_surat)) }}</td>
                    <td>{{ $surat->no_surat }}</td>
                    <td>{{ $surat->perihal }}</td>
                    <td>{{ $surat->jenis }}</td>
                    <td>{{ $surat->petugas->jabatan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        {{-- <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p> --}}
        <div class="signature">
            <p>Mengetahui,</p>
            <br><br><br>
            <p>____________________</p>
            <p>Kepala Bagian</p>
        </div>
    </div>

    <script>
        // Auto print when page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
