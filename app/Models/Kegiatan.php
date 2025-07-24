<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Kegiatan extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'users_id', 'nama_kegiatan', 'tanggal_mulai', 'tanggal_selesai',
        'deskripsi', 'proposal_file', 'rab_file', 'lpj_file'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'kegiatan_id');
    }

    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'kegiatan_id');
    }
}
