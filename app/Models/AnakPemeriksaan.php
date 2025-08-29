<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnakPemeriksaan extends Model
{
    protected $primaryKey = 'id_anak_pemeriksaan';
    protected $fillable = [
        'user_id',
        'anak_id',
        'bb',
        'kesimpulan_hasil_bb',
        'kesimpulan_hasil_pengukuran_bb',
        'tb',
        'kesimpulan_hasil_tb',
        'kesimpulan_hasil_pengukuran_imt',
        'lingkar_kepala',
        'kesimpulan_lk',
        'lingkar_lengan_atas',
        'kesimpulan_lla',
        'asi_eksklusif',
        'mp_asi',
        'imunisasi',
        'vitamin_a',
        'obat_cacing',
        'mt_pangan_lokal',
        'gejala_sakit',
        'diagnosa',
        'keterangan',
        'skrining_tbc_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function anak()
    {
        return $this->belongsTo(User::class, 'anak_id', 'id_user');
    }

    public function skriningTbc()
    {
        return $this->belongsTo(SkriningTbc::class, 'skrining_tbc_id', 'id_skrining_tbc');
    }
}
