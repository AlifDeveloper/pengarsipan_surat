<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat_masuk extends Model
{
    use HasFactory;

    public $table = 'surat_masuk';
    protected $primaryKey = 'no_suratmasuk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_suratmasuk',
        'asal_surat',
        'tgl_surat',
        'perihal',
        'kode_arsip',
        'nip',
        'lampiran_pdf',
        'lampiran_gambar'
    ];

    public function petugas()
    {
        return $this->belongsTo(petugas::class, 'nip', 'nip');    
    }

    public function klasifikasi_arsip()
    {
        return $this->belongsTo(klasifikasi_arsip::class, 'kode_arsip', 'kode_arsip');    
    }

    public function disposisi()
    {
        return $this->belongsTo(disposisi::class, 'kode_arsip', 'kode_arsip');    
    }
}
