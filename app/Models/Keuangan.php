<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Keuangan extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kegiatan_id',
        'users_id',
        'jenis_transaksi',
        'jumlah',
        'keterangan',
        'bukti_file',
        'tanggal',
        'lpj_file'
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
