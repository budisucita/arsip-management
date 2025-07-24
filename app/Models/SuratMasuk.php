<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class SuratMasuk extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'surat_masuk';

    protected $fillable = [
        'users_id',
        'no_surat',
        'pengirim',
        'tanggal_terima',
        'perihal',
        'file_surat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
