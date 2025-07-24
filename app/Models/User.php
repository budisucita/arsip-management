<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UUID;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UUID;

    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'nama',  
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function getAuthIdentifierName()
    {
        return 'email';
    }

    // Relasi
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'users_id');
    }

    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'users_id');
    }

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class, 'users_id');
    }

    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class, 'users_id');
    }

    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'users_id');
    }
}
