<?php

namespace App\Http\Controllers;

use App\Models\disposisi;
use App\Models\klasifikasi_arsip;
use App\Models\petugas;
use App\Models\sifat_arsip;
use App\Models\surat_masuk;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil bulan & tahun dari request
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Query builder untuk surat masuk
        $query = surat_masuk::with(['klasifikasi_arsip', 'petugas']);

        // Jika ada filter bulan dan tahun, terapkan filter
        if ($bulan) {
            $query->whereMonth('tgl_surat', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tgl_surat', $tahun);
        }

        if ($bulan && !$tahun) {
            $query->whereMonth('tgl_surat', $bulan)->whereYear('tgl_surat', date('Y'));
        }

        // Jika tidak ada filter (keduanya kosong), tampilkan data bulan dan tahun saat ini
        if (!$bulan && !$tahun) {
            $query->whereMonth('tgl_surat', date('m'))
                ->whereYear('tgl_surat', date('Y'));
        }

        // Ambil data dengan pagination
        $surat_masuk = $query->paginate(10)->appends($request->except('page'));

        $title = 'Surat Masuk';
        return view('content.pengarsipan.suratMasuk.index', compact('surat_masuk', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sifat = sifat_arsip::all();
        $klasifikasi = klasifikasi_arsip::all();
        $petugas = petugas::all();
        $title = 'Tambah Surat Masuk';
        return view('content.pengarsipan.suratMasuk.create', compact('klasifikasi', 'petugas', 'sifat', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_suratmasuk' => 'required|unique:surat_masuk,no_suratmasuk',
            'asal_surat' => 'required',
            'tgl_surat' => 'required|date',
            'perihal' => 'required',
            'kode_arsip' => 'required',
            'nip' => 'required',
            // 'lampiran_pdf' => 'nullable|mimes:pdf|max:2048',
            'lampiran_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // simpan file pdf
        // if ($request->hasFile('lampiran_pdf')){
        //     $pdfPath = $request->file('lampiran_pdf')->store('lampiran/pdf', 'public');
        // } else {
        //     $pdfPath = null;
        // }

        // simpan file gambar
        if ($request->hasFile('lampiran_gambar')){
            $gambarPath = $request->file('lampiran_gambar')->store('lampiran/gambar', 'public');
        } else {
            $gambarPath = null;
        }

        $data = new surat_masuk;
        $data->no_suratmasuk = $request->no_suratmasuk;
        $data->asal_surat = $request->asal_surat;
        $data->tgl_surat = $request->tgl_surat;
        $data->perihal = $request->perihal;
        $data->kode_arsip = $request->kode_arsip;
        $data->nip = $request->nip;
        // $data->lampiran_pdf = $pdfPath;
        $data->lampiran_gambar = $gambarPath;
        $data->save();

        if ($request->has('tgl_surat_keluar') && $request->has('diteruskan') && $request->has('sifat')) {
            // Generate nomor disposisi otomatis
            $lastDisposisi = Disposisi::orderBy('no_disposisi', 'desc')->first();
            if ($lastDisposisi) {
                $lastNumber = (int) substr($lastDisposisi->no_disposisi, 4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            $newNoDisposisi = 'DISP' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            $disposisi = new disposisi();
            $disposisi->no_disposisi = $newNoDisposisi;
            $disposisi->no_suratmasuk = $data->no_suratmasuk;
            $disposisi->tgl_diterima = $request->tgl_surat_keluar;
            $disposisi->perihal = $data->perihal;
            $disposisi->tujuan_surat = $request->diteruskan;
            $disposisi->kode_sifat = $request->sifat;
            $disposisi->nip = $data->nip;
            $disposisi->lampiran_gambar = $gambarPath;
            $disposisi->save();
        }

        return redirect(route('surat-masuk.index'))->with('success', 'Arsip berhasil disimpan')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sifat = sifat_arsip::all();
        $klasifikasi = klasifikasi_arsip::all();
        $petugas = petugas::all();
        $title = 'Edit Surat Masuk';
        $suratMasuk = surat_masuk::with(['klasifikasi_arsip', 'petugas', ])->findOrFail($id);
        $disposisi = disposisi::where('no_suratmasuk',$suratMasuk->no_suratmasuk)->first();
        return view('content.pengarsipan.suratMasuk.edit', compact('sifat', 'klasifikasi', 'petugas', 'title', 'suratMasuk', 'disposisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_suratmasuk' => 'required|unique:surat_masuk,no_suratmasuk,'.$id.',no_suratmasuk',
            'asal_surat' => 'required',
            'tgl_surat' => 'required|date',
            'perihal' => 'required',
            'kode_arsip' => 'required',
            'nip' => 'required',
            // 'lampiran_pdf' => 'nullable|mimes:pdf|max:2048',
            'lampiran_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // simpan file pdf
        // if ($request->hasFile('lampiran_pdf')){
        //     $pdfPath = $request->file('lampiran_pdf')->store('lampiran/pdf', 'public');
        // } else {
        //     $pdfPath = null;
        // }

        // simpan file gambar
        if ($request->hasFile('lampiran_gambar')){
            $gambarPath = $request->file('lampiran_gambar')->store('lampiran/gambar', 'public');
        } else {
            $gambarPath = null;
        }

        $data = surat_masuk::find($id);

        $data->no_suratmasuk = $request->no_suratmasuk;
        $data->asal_surat = $request->asal_surat;
        $data->tgl_surat = $request->tgl_surat;
        $data->perihal = $request->perihal;
        $data->kode_arsip = $request->kode_arsip;
        $data->nip = $request->nip;
        // $data->lampiran_pdf = $pdfPath;
        if ($gambarPath == null) {
            $data->lampiran_gambar = $data->lampiran_gambar;
        } else {
            $data->lampiran_gambar = $gambarPath;
        }
        $data->save();

        if ($request->has('tgl_surat_keluar') && $request->has('diteruskan') && $request->has('sifat')) {
            // Cek disposisi yang sudah ada berdasarkan no_suratmasuk
            $existingDisposisi = disposisi::where('no_suratmasuk', $data->no_suratmasuk)->first();

            if ($existingDisposisi) {
                // Update disposisi yang sudah ada
                $existingDisposisi->tgl_diterima = $request->tgl_surat_keluar;
                $existingDisposisi->perihal = $data->perihal; // Ambil dari surat masuk yang baru diupdate
                $existingDisposisi->tujuan_surat = $request->diteruskan;
                $existingDisposisi->kode_sifat = $request->sifat;
                $existingDisposisi->nip = $data->nip; // Ambil dari surat masuk yang baru diupdate
                $existingDisposisi->lampiran_gambar = $gambarPath ?? $existingDisposisi->lampiran_gambar;
                $existingDisposisi->save();
            } else {
                // Buat disposisi baru jika belum ada
                $lastDisposisi = disposisi::orderBy('no_disposisi', 'desc')->first();
                if ($lastDisposisi) {
                    $lastNumber = (int) substr($lastDisposisi->no_disposisi, 4);
                    $newNumber = $lastNumber + 1;
                } else {
                    $newNumber = 1;
                }
                $newNoDisposisi = 'DISP' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

                $disposisi = new disposisi();
                $disposisi->no_disposisi = $newNoDisposisi;
                $disposisi->no_suratmasuk = $data->no_suratmasuk;
                $disposisi->tgl_diterima = $request->tgl_surat_keluar;
                $disposisi->perihal = $data->perihal;
                $disposisi->tujuan_surat = $request->diteruskan;
                $disposisi->kode_sifat = $request->sifat;
                $disposisi->nip = $data->nip;
                $disposisi->lampiran_gambar = $gambarPath;
                $disposisi->save();
            }
        }

        return redirect(route('surat-masuk.index'))->with('success', 'Arsip berhasil diperbarui')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = surat_masuk::findOrFail($id);
        $item->delete();

        return redirect(route('surat-masuk.index'))->with('success', 'Arsip berhasil dihapus')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }
}
