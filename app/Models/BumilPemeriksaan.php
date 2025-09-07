<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BumilPemeriksaan extends Model
{
    protected $primaryKey = 'id_bumil_pemeriksaan';
    protected $fillable = [
        'user_id',
        'bumil_id',
        'usia_kehamilan',
        'berat_badan',
        'lila',
        'sistole_distole',
        'keluhan_lain',
        'diagnosa',
        'keterangan',
        'jumlah_ttd',
        'jadwal_ttd',
        'komposisi_jumlah_porsi',
        'jadwal_mt',
        'ikut_kelas_bumil',
        'edukasi',
        'skrining_tbc_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function bumil()
    {
        return $this->belongsTo(User::class, 'bumil_id', 'id_user');
    }

    public function skriningTbc()
    {
        return $this->belongsTo(SkriningTbc::class, 'skrining_tbc_id', 'id_skrining_tbc');
    }
}
