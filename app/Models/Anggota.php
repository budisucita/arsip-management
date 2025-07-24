<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;


class Anggota extends Model
{
    use UUID;

    protected $table = 'anggota';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['nama', 'kontak', 'status', 'alamat', 'foto'];
}
