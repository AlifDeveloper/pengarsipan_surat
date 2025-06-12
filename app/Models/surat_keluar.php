<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat_keluar extends Model
{
    use HasFactory;

    public $table = 'surat_keluar';
    protected $primaryKey = 'no_suratkeluar';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_suratkeluar',
        'tgl_surat',
        'tujuan',
        'perihal',
        'kode_arsip',
        'nip',
        'lampiran_pdf',
        'lampiran_gambar'
    ];

    public function klasifikasi_arsip()
    {
        return $this->belongsTo(klasifikasi_arsip::class, 'kode_arsip', 'kode_arsip');    
    }

    public function petugas()
    {
        return $this->belongsTo(petugas::class, 'nip', 'nip');    
    }
}
