<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Bukti Timbangan</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            color: #000;
            background: #e5e7eb;
            margin: 0;
            padding: 20px;
        }

        .invoice-container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
            padding: 5mm 10mm;
            background: #fff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            page-break-inside: avoid;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 2px dashed #000;
            padding-bottom: 5px;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
            letter-spacing: 1px;
        }

        .header h3 {
            margin: 3px 0 0 0;
            font-size: 16px;
            font-weight: normal;
        }

        .info-table {
            width: 100%;
            margin-bottom: 10px;
        }

        .info-table td {
            padding: 2px 0;
            vertical-align: top;
        }

        .info-table td:nth-child(1), .info-table td:nth-child(4) {
            width: 15%;
            font-weight: bold;
        }

        .info-table td:nth-child(2), .info-table td:nth-child(5) {
            width: 35%;
        }

        .weight-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            border-top: 2px dashed #000;
            border-bottom: 2px dashed #000;
        }

        .weight-table th, .weight-table td {
            padding: 6px 10px;
            text-align: right;
        }

        .weight-table th:first-child, .weight-table td:first-child {
            text-align: left;
        }

        .weight-table th {
            border-bottom: 1px dashed #000;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            text-align: center;
        }

        .sig-box {
            width: 30%;
        }

        .sig-line {
            margin-top: 40px;
            border-bottom: 1px dashed #000;
            display: inline-block;
            width: 80%;
            padding-bottom: 2px;
        }

        @media print {
            @page {
                size: 215mm 140mm; /* Continuous form half-page size */
                margin: 0mm;
            }
            body { 
                margin: 0;
                padding: 0;
                background: #fff;
            }
            .invoice-container {
                box-shadow: none;
                width: 100%;
                min-height: auto;
                padding: 5mm;
                page-break-after: avoid;
                page-break-before: avoid;
            }
            .no-print { display: none; }
        }
        
        .btn-back {
            display: block;
            margin: 0 auto 20px auto;
            padding: 10px 20px;
            background: #2563eb;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            width: fit-content;
            font-family: sans-serif;
            font-weight: bold;
        }
    </style>
</head>
<body onload="window.print()">

    <!-- Print dialog is triggered via body onload -->

    <div class="invoice-container">
        <div class="header">
            <h2>PT. PRAMANA AUSTINDO MAHARDIKA</h2>
            <h3>BUKTI TIMBANGAN / SURAT JALAN</h3>
        </div>

        <table class="info-table">
            <tr>
                <td>No. TTBM</td>
                <td>: {{ $weighing->ticket_number }}</td>
                <td>&nbsp;</td>
                <td>Tanggal</td>
                <td>: {{ $weighing->receipt_date->format('d/m/Y H:i:s') }}</td>
            </tr>
            <tr>
                <td>Pengirim</td>
                <td>: {{ $weighing->sender->name }}</td>
                <td>&nbsp;</td>
                <td>Kendaraan</td>
                <td>: {{ $weighing->vehicle->plate_number }}</td>
            </tr>
            <tr>
                <td>Barang</td>
                <td>: {{ $weighing->item->name }}</td>
                <td>&nbsp;</td>
                <td>Sopir</td>
                <td>: {{ $weighing->driver->name }}</td>
            </tr>
        </table>

        <table class="weight-table">
            <tr>
                <th>Keterangan</th>
                <th>Berat (KG)</th>
            </tr>
            <tr>
                <td>Berat Kotor (Bruto)</td>
                <td>{{ number_format($weighing->gross_weight, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Berat Kendaraan (Tara)</td>
                <td>{{ number_format($weighing->tare_weight, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; font-size: 16px;">Berat Bersih (Netto)</td>
                <td style="font-weight: bold; font-size: 16px;">{{ number_format($weighing->net_weight, 2, ',', '.') }}</td>
            </tr>
        </table>

        <div class="signatures">
            <div class="sig-box">
                Penerima / Mengetahui
                <br>
                <span class="sig-line"></span>
            </div>
            <div class="sig-box">
                Sopir
                <br>
                <span class="sig-line">{{ $weighing->driver->name }}</span>
            </div>
            <div class="sig-box">
                Petugas Timbang
                <br>
                <span class="sig-line">{{ $weighing->user->name ?? 'Admin' }}</span>
            </div>
        </div>
    </div>

</body>
</html>
