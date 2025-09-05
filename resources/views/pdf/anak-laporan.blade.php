<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemeriksaan Anak</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #000;
            padding: 3px;
            text-align: center;
            word-wrap: break-word;
        }
        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>
    <h3 style="text-align: center;">Laporan Pemeriksaan Anak</h3>
    <h3 style="text-align: center;">Posyandu Desa Ketawang Karay Ganding Sumenep</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Anak</th>
                <th rowspan="2">BB</th>
                <th rowspan="2">Kesimpulan BB</th>
                <th rowspan="2">Kesimpulan Pengukuran BB</th>
                <th rowspan="2">TB</th>
                <th rowspan="2">Kesimpulan TB</th>
                <th rowspan="2">Kesimpulan IMT</th>
                <th rowspan="2">Lingkar Kepala</th>
                <th rowspan="2">Kesimpulan LK</th>
                <th rowspan="2">Lingkar Lengan Atas</th>
                <th rowspan="2">Kesimpulan LLA</th>
                <th rowspan="2">ASI Eksklusif</th>
                <th rowspan="2">MP ASI</th>
                <th rowspan="2">Imunisasi</th>
                <th rowspan="2">Vitamin A</th>
                <th rowspan="2">Obat Cacing</th>
                <th rowspan="2">MT Pangan Lokal</th>
                <th rowspan="2">Gejala Sakit</th>
                <th rowspan="2">Diagnosa</th>
                <th rowspan="2">Keterangan</th>
                <th colspan="5">Skrining TBC</th>
                <th rowspan="2">Petugas</th>
            </tr>
            <tr>
                <th>Batuk ≥2 Minggu</th>
                <th>Demam Lama</th>
                <th>BB Turun</th>
                <th>Berkeringat Malam</th>
                <th>Kontak TB</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemeriksaans as $i => $p)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $p->anak->name ?? '-' }}</td>
                    <td>{{ $p->bb }}</td>
                    <td>{{ $p->kesimpulan_hasil_bb }}</td>
                    <td>{{ $p->kesimpulan_hasil_pengukuran_bb }}</td>
                    <td>{{ $p->tb }}</td>
                    <td>{{ $p->kesimpulan_hasil_tb }}</td>
                    <td>{{ $p->kesimpulan_hasil_pengukuran_imt }}</td>
                    <td>{{ $p->lingkar_kepala }}</td>
                    <td>{{ $p->kesimpulan_lk }}</td>
                    <td>{{ $p->lingkar_lengan_atas }}</td>
                    <td>{{ $p->kesimpulan_lla }}</td>
                    <td>{{ $p->asi_eksklusif ?? '-' }}</td>
                    <td>{{ $p->mp_asi ?? '-' }}</td>
                    <td>{{ $p->imunisasi }}</td>
                    <td>{{ $p->vitamin_a ?? '-' }}</td>
                    <td>{{ $p->obat_cacing ?? '-' }}</td>
                    <td>{{ $p->mt_pangan_lokal ?? '-' }}</td>
                    <td>{{ $p->gejala_sakit ?? '-' }}</td>
                    <td>{{ $p->diagnosa ?? '-' }}</td>
                    <td>{{ $p->keterangan ?? '-' }}</td>
                    <td>{{ $p->skriningTbc->batuk ?? '-' }}</td>
                    <td>{{ $p->skriningTbc->demam ?? '-' }}</td>
                    <td>{{ $p->skriningTbc->bb_turun ?? '-' }}</td>
                    <td>{{ $p->skriningTbc->keringat_malam ?? '-' }}</td>
                    <td>{{ $p->skriningTbc->kontak_tb ?? '-' }}</td>
                    <td>{{ $p->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
