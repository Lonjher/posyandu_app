<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LansiaPemeriksaan extends Model
{
    protected $primaryKey = 'id_lansia_pemeriksaan';
    protected $fillable = [
        'user_id',
        'lansia_id',
        'bb',
        'tb',
        'imt',
        'lingkar_perut',
        'tekanan_darah',
        'gula_darah',
        'mata_kanan',
        'mata_kiri',
        'telinga_kanan',
        'telinga_kiri',
        'usia',
        'menggunakan_alat_kontrasepsi',
        'diagnosa',
        'edukasi',
        'keterangan',
        'skrining_tbc_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function lansia()
    {
        return $this->belongsTo(User::class, 'lansia_id', 'id_user');
    }

    public function skriningTbc()
    {
        return $this->belongsTo(SkriningTbc::class, 'skrining_tbc_id', 'id_skrining_tbc');
    }
}
