<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Dokumentasi extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'dokumentasi';

    protected $fillable = [
        'kegiatan_id',
        'users_id',
        'tipe',
        'file_path',
        'deskripsi',
        'uploaded_at',
    ];

    public $timestamps = false;

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
