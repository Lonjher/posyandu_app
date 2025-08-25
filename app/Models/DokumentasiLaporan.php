<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiLaporan extends Model
{
    protected $primaryKey = 'id_dokumentasi';
    protected $fillable = [
        'laporan_id',
        'photo_path',
    ];

    public function laporanKegiatan()
    {
        return $this->belongsTo(LaporanKegiatan::class, 'laporan_id', 'id_laporan');
    }
}
