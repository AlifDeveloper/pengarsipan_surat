<?php

namespace App\Http\Controllers;

use App\Models\klasifikasi_arsip;
use App\Models\petugas;
use App\Models\surat_keluar;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
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
        $query = surat_keluar::with(['klasifikasi_arsip', 'petugas']);

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
        $surat_keluar = $query->paginate(10)->appends($request->except('page'));

        $title = 'Surat Keluar';
        return view('content.pengarsipan.suratKeluar.index', compact('surat_keluar', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $klasifikasi = klasifikasi_arsip::all();
        $petugas = petugas::all();
        $title = 'Tambah Surat Keluar';
        return view('content.pengarsipan.suratKeluar.create', compact('klasifikasi', 'petugas', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_suratkeluar' => 'required|unique:surat_keluar,no_suratkeluar',
            'tgl_surat' => 'required|date',
            'tujuan' => 'required',
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

        $data = new surat_keluar;
        $data->no_suratkeluar = $request->no_suratkeluar;
        $data->tgl_surat = $request->tgl_surat;
        $data->tujuan = $request->tujuan;
        $data->perihal = $request->perihal;
        $data->kode_arsip = $request->kode_arsip;
        $data->nip = $request->nip;
        // $data->lampiran_pdf = $pdfPath;
        $data->lampiran_gambar = $gambarPath;
        $data->save();

        return redirect(route('surat-keluar.index'))->with('success', 'Arsip keluar berhasil disimpan')->withHeaders([
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
        $klasifikasi = klasifikasi_arsip::all();
        $petugas = petugas::all();
        $title = 'Edit Surat Keluar';
        $suratKeluar = surat_keluar::find($id);
        return view('content.pengarsipan.suratKeluar.edit', compact('klasifikasi', 'petugas', 'title', 'suratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_suratkeluar' => 'required|unique:surat_keluar,no_suratkeluar,'.$id.',no_suratkeluar',
            'tgl_surat' => 'required|date',
            'tujuan' => 'required',
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

        $data = surat_keluar::find($id);
        $data->no_suratkeluar = $request->no_suratkeluar;
        $data->tgl_surat = $request->tgl_surat;
        $data->tujuan = $request->tujuan;
        $data->perihal = $request->perihal;
        $data->kode_arsip = $request->kode_arsip;
        $data->nip = $request->nip;
        // $data->lampiran_pdf = $pdfPath;
        $data->lampiran_gambar = $gambarPath;
        $data->update();

        return redirect(route('surat-keluar.index'))->with('success', 'Arsip keluar berhasil diupdate')->withHeaders([
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
        $item = surat_keluar::findOrFail($id);
        $item->delete();

        return redirect(route('surat-keluar.index'))->with('success', 'Arsip keluar berhasil dihapus')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }
}
