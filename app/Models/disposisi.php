<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class disposisi extends Model
{
    use HasFactory;

    public $table = 'disposisi';
    protected $primaryKey = 'no_disposisi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_disposisi',
        'no_suratmasuk',
        'tgl_diterima',
        'perihal',
        'tujuan_surat',
        'nip',
        'kode_sifat',
        'lampiran_pdf',
        'lampiran_gambar'
    ];

    public function surat_masuk()
    {
        return $this->belongsTo(surat_masuk::class, 'no_suratmasuk', 'no_suratmasuk');
    }

    public function petugas()
    {
        return $this->belongsTo(petugas::class, 'nip', 'nip');
    }

    public function sifat_arsip()
    {
        return $this->belongsTo(sifat_arsip::class, 'kode_sifat', 'kode_sifat');
    }

    public function klasifikasi_arsip()
    {
        return $this->belongsTo(klasifikasi_arsip::class, 'kode_arsip','kode_arsip');
    }

}
