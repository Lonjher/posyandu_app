<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Times New Romas';
            font-size: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            word-wrap: break-word;
        }
        th {
            background: #f2f2f2;
        }
        .col-span {
            background: #e0e0e0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h3 style="text-align:center;">Laporan Pemeriksaan Ibu Hamil</h3>
    <h3 style="text-align:center;">Posyandu Desa Ketawang Karay Ganding Sumenep</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Pasien</th>
                <th rowspan="2">Usia Kehamilan</th>
                <th rowspan="2">Berat Badan</th>
                <th rowspan="2">LILA</th>
                <th rowspan="2">TD (S/D)</th>
                <th rowspan="2">Keluhan Lain</th>
                <th rowspan="2">Diagnosa</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Jumlah TTD</th>
                <th rowspan="2">Jadwal TTD</th>
                <th rowspan="2">Komposisi / Porsi</th>
                <th rowspan="2">Jadwal MT</th>
                <th rowspan="2">Ikut Kelas</th>
                <th rowspan="2">Edukasi</th>
                <th colspan="4" class="col-span">Skrining TBC</th>
            </tr>
            <tr>
                <th>Batuk ≥2 Minggu</th>
                <th>Demam >2 Minggu</th>
                <th>BB Turun Tanpa Sebab</th>
                <th>Kontak TBC</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemeriksaans as $index => $periksa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $periksa->bumil->name ?? '-' }}</td>
                    <td>{{ $periksa->usia_kehamilan }}</td>
                    <td>{{ $periksa->berat_badan }}</td>
                    <td>{{ $periksa->lila }}</td>
                    <td>{{ $periksa->sistole_distole }}</td>
                    <td>{{ $periksa->keluhan_lain ?? '-' }}</td>
                    <td>{{ $periksa->diagnosa ?? '-' }}</td>
                    <td>{{ $periksa->keterangan ?? '-' }}</td>
                    <td>{{ $periksa->jumlah_ttd ?? '-' }}</td>
                    <td>{{ $periksa->jadwal_ttd ?? '-' }}</td>
                    <td>{{ $periksa->komposisi_jumlah_porsi ?? '-' }}</td>
                    <td>{{ $periksa->jadwal_mt ?? '-' }}</td>
                    <td>{{ $periksa->ikut_kelas_bumil ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $periksa->edukasi ?? '-' }}</td>

                    {{-- Skrining TBC --}}
                    <td>{{ $periksa->skriningTbc->batuk_terus_menerus ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $periksa->skriningTbc->demam_lebih_dari_2_minggu ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $periksa->skriningTbc->berat_badan_turun_tanpa_sebab_jelas ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $periksa->skriningTbc->kontak_dengan_orang_terinfeksi_tbc ? 'Ya' : 'Tidak' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
