<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkriningTbc extends Model
{
    protected $primaryKey = 'id_skrining_tbc';
    protected $fillable = [
        'batuk_terus_menerus',
        'demam_lebih_dari_2_minggu',
        'berat_badan_turun_tanpa_sebab_jelas',
        'kontak_dengan_orang_terinfeksi_tbc',
    ];

    public function bumilPemeriksaan()
    {
        return $this->hasOne(BumilPemeriksaan::class, 'skrining_tbc_id', 'id_skrining_tbc');
    }
}
