<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKegiatan extends Model
{
    protected $primaryKey = 'id_laporan';
    protected $fillable = [
        'nama_kegiatan',
        'tanggal_kegiatan',
        'deskripsi_kegiatan',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function dokumentasi()
    {
        return $this->hasMany(DokumentasiLaporan::class, 'laporan_id', 'id_laporan');
    }
}
