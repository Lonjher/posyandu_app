<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edukasi extends Model
{
    protected $primaryKey = 'id_edukasi';
    protected $fillable = ['judul', 'gambar', 'kategori', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}
