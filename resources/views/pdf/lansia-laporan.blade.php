<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemeriksaan Lansia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px; /* kecil agar muat satu halaman */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* biar rapi */
        }
        th, td {
            border: 1px solid #000;
            padding: 2px;
            word-wrap: break-word;
            text-align: center;
        }
        th {
            background: #f2f2f2;
        }
        .colspan {
            background: #e6e6e6;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h3 style="text-align:center;">Laporan Pemeriksaan Lansia</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Lansia</th>
                <th rowspan="2">Pemeriksa</th>
                <th rowspan="2">Usia</th>
                <th rowspan="2">BB</th>
                <th rowspan="2">TB</th>
                <th rowspan="2">IMT</th>
                <th rowspan="2">Lingkar Perut</th>
                <th rowspan="2">Tekanan Darah</th>
                <th rowspan="2">Gula Darah</th>
                <th colspan="2">Mata</th>
                <th colspan="2">Telinga</th>
                <th rowspan="2">Alat Kontrasepsi</th>
                <th rowspan="2">Diagnosa</th>
                <th rowspan="2">Keterangan</th>
                <th colspan="5">Skrining TBC</th>
            </tr>
            <tr>
                <th>Kanan</th>
                <th>Kiri</th>
                <th>Kanan</th>
                <th>Kiri</th>
                <th>Batuk ≥2 minggu</th>
                <th>Demam</th>
                <th>Berkeringat Malam</th>
                <th>BB Turun</th>
                <th>Riwayat Kontak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemeriksaans as $i => $p)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $p->lansia->name ?? '-' }}</td>
                <td>{{ $p->user->nama ?? '-' }}</td>
                <td>{{ $p->usia }}</td>
                <td>{{ $p->bb }}</td>
                <td>{{ $p->tb }}</td>
                <td>{{ $p->imt }}</td>
                <td>{{ $p->lingkar_perut }}</td>
                <td>{{ $p->tekanan_darah }}</td>
                <td>{{ $p->gula_darah }}</td>
                <td>{{ $p->mata_kanan }}</td>
                <td>{{ $p->mata_kiri }}</td>
                <td>{{ $p->telinga_kanan }}</td>
                <td>{{ $p->telinga_kiri }}</td>
                <td>{{ $p->menggunakan_alat_kontrasepsi ? 'Ya' : 'Tidak' }}</td>
                <td>{{ $p->diagnosa }}</td>
                <td>{{ $p->keterangan }}</td>
                <td>{{ $p->skriningTbc->batuk ?? '-' }}</td>
                <td>{{ $p->skriningTbc->demam ?? '-' }}</td>
                <td>{{ $p->skriningTbc->keringat_malam ?? '-' }}</td>
                <td>{{ $p->skriningTbc->bb_turun ?? '-' }}</td>
                <td>{{ $p->skriningTbc->riwayat_kontak ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
