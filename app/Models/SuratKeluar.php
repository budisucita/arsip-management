<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class SuratKeluar extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'users_id',
        'no_surat',
        'penerima',
        'tanggal_kirim',
        'perihal',
        'file_surat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
