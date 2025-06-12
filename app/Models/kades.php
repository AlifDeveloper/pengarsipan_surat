<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kades extends Model
{
    use HasFactory;

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'nama',
        'tgl_lahir',
        'jabatan',
        'alamat',
        'no_telp',
        'id_users'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id_users', 'id');
    }
}
