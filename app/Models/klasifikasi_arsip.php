<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class klasifikasi_arsip extends Model
{
    use HasFactory;

    public $table = 'klasifikasi_arsip';
    protected $primaryKey = 'kode_arsip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_arsip',
        'nama_arsip',
    ];

    public function surat_masuk()
    {
        return $this->hasMany(surat_masuk::class, 'kode_arsip', 'kode_arsip');    
    }

    public function surat_keluar()
    {
        return $this->hasMany(surat_keluar::class, 'kode_arsip', 'kode_arsip');    
    }
}
