<?php

namespace App\Http\Controllers;

use App\Models\disposisi;
use App\Models\petugas;
use App\Models\sifat_arsip;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DisposisiController extends Controller
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
        $query = disposisi::with(['klasifikasi_arsip', 'petugas']);

        // Jika ada filter bulan dan tahun, terapkan filter
        if ($bulan) {
            $query->whereMonth('tgl_diterima', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tgl_diterima', $tahun);
        }

        if ($bulan && !$tahun) {
            $query->whereMonth('tgl_diterima', $bulan)->whereYear('tgl_diterima', date('Y'));
        }

        // Jika tidak ada filter (keduanya kosong), tampilkan data bulan dan tahun saat ini
        if (!$bulan && !$tahun) {
            $query->whereMonth('tgl_diterima', date('m'))
                ->whereYear('tgl_diterima', date('Y'));
        }

        // Ambil data dengan pagination
        $disposisi = $query->paginate(10)->appends($request->except('page'));

        $title = 'Surat Masuk';
        return view('content.pengarsipan.disposisi.index', compact('disposisi', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $petugas = petugas::all();
        $sifat = sifat_arsip::all();
        $title = 'Tambah Disposisi';
        return view('content.pengarsipan.disposisi.create', compact('petugas', 'sifat', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_suratmasuk' => 'required',
            'tgl_diterima' => 'required|date',
            'perihal' => 'required',
            'tujuan_surat' => 'required',
            'kode_sifat' => 'required',
            'nip' => 'required',
            // 'lampiran_pdf' => 'nullable|mimes:pdf|max:2048',
            'lampiran_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate nomor disposisi otomatis
        $lastDisposisi = Disposisi::orderBy('no_disposisi', 'desc')->first();
        if ($lastDisposisi) {
            $lastNumber = (int) substr($lastDisposisi->no_disposisi, 4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $newNoDisposisi = 'DISP' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Simpan file PDF
        // if ($request->hasFile('lampiran_pdf')) {
        //     $pdfPath = $request->file('lampiran_pdf')->store('lampiran/pdf', 'public');
        // } else {
        //     $pdfPath = null;
        // }

        // Simpan file gambar
        if ($request->hasFile('lampiran_gambar')) {
            $gambarPath = $request->file('lampiran_gambar')->store('lampiran/gambar', 'public');
        } else {
            $gambarPath = null;
        }

        // Simpan ke database
        $data = new Disposisi;
        $data->no_disposisi = $newNoDisposisi; // Primary Key
        $data->no_suratmasuk = $request->no_suratmasuk;
        $data->tgl_diterima = $request->tgl_diterima;
        $data->perihal = $request->perihal;
        $data->tujuan_surat = $request->tujuan_surat;
        $data->kode_sifat = $request->kode_sifat;
        $data->nip = $request->nip;
        // $data->lampiran_pdf = $pdfPath;
        $data->lampiran_gambar = $gambarPath;
        $data->save();

        return redirect(route('disposisi.index'))->with('success', 'Arsip berhasil disimpan')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }


    public function cetak($no_disposisi)
    {
        $disposisi = disposisi::with('surat_masuk', 'sifat_arsip', 'petugas')->findOrFail($no_disposisi);
        $pdf = Pdf::loadView('content.pengarsipan.disposisi.cetakDisposisi', compact('disposisi'));
        $filename = 'lembar_disposisi_' . str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '_', $disposisi->perihal) . '.pdf';

        // return $pdf->stream($filename);
        // return $pdf->stream('lembar_disposisi.pdf');
        return $pdf->download($filename);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
