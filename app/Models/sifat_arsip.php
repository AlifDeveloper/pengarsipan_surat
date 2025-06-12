<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sifat_arsip extends Model
{
    use HasFactory;

    public $table = 'sifat_arsip';
    protected $primaryKey = 'kode_sifat';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_sifat',
        'nama_sifat'
    ];

    public function disposisi()
    {
        return $this->hasMany(disposisi::class, 'kode_sifat', 'kode_sifat');    
    }
}
