<?php

namespace App\Http\Controllers;

use App\Models\klasifikasi_arsip;
use App\Models\surat_keluar;
use App\Models\surat_masuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class laporan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $arsip = $request->input('arsip');

        $klasifikasi_arsip = klasifikasi_arsip::all();

        // Mulai query tanpa langsung dieksekusi
        $suratMasuk = surat_masuk::query();
        $suratKeluar = surat_keluar::query();

        // Terapkan filter bulan
        if ($bulan) {
            $suratMasuk->whereMonth('tgl_surat', $bulan);
            $suratKeluar->whereMonth('tgl_surat', $bulan);
        }

        // Terapkan filter tahun
        if ($tahun) {
            $suratMasuk->whereYear('tgl_surat', $tahun);
            $suratKeluar->whereYear('tgl_surat', $tahun);
        }

        // Terapkan filter arsip
        if ($arsip) {
            $suratMasuk->where('kode_arsip', $arsip);
            $suratKeluar->where('kode_arsip', $arsip);
        }

        if ($bulan && !$tahun) {
            $suratMasuk->whereMonth('tgl_surat', $bulan)->whereYear('tgl_surat', date('Y'));
            $suratKeluar->whereMonth('tgl_surat', $bulan)->whereYear('tgl_surat', date('Y'));
        }

        // Jika tidak ada filter, gunakan bulan & tahun saat ini
        if (!$bulan && !$tahun && !$arsip) {
            $suratMasuk->whereMonth('tgl_surat', date('m'))->whereYear('tgl_surat', date('Y'));
            $suratKeluar->whereMonth('tgl_surat', date('m'))->whereYear('tgl_surat', date('Y'));
        }

        // Ambil data surat masuk
        $queryMasuk = $suratMasuk->select(
                DB::raw("CONCAT('M', no_suratmasuk) as id"),
                'tgl_surat',
                'no_suratmasuk as no_surat',
                'perihal',
                'asal_surat',
                'kode_arsip',
                'lampiran_pdf',
                'lampiran_gambar',
                'nip',
                DB::raw("'Masuk' as jenis")
            )
            ->with(['petugas', 'klasifikasi_arsip']);

        // Ambil data surat keluar
        $queryKeluar = $suratKeluar->select(
                DB::raw("CONCAT('K', no_suratkeluar) as id"),
                'tgl_surat',
                'no_suratkeluar as no_surat',
                'perihal',
                'tujuan',
                'kode_arsip',
                'lampiran_pdf',
                'lampiran_gambar',
                'nip',
                DB::raw("'Keluar' as jenis")
            )
            ->with(['petugas']);

        // Gabungkan kedua query dengan UNION dan order by tanggal
        $dataSurat = $queryMasuk->union($queryKeluar)
            ->orderBy('tgl_surat', 'desc')
            ->paginate(10);

        $bulanIndonesia = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        // Hitung total surat masuk & keluar
        $totalSuratMasuk = $suratMasuk->count();
        $totalSuratKeluar = $suratKeluar->count();

        $month = $bulan ?? now()->format('m');
            $month = \Carbon\Carbon::createFromFormat('m', $month);
            $bulan = $month->translatedFormat('F');

            $year = $tahun ?? now()->format('Y');
            $year = \Carbon\Carbon::createFromFormat('Y', $year);
            $tahun = $year->translatedFormat('Y');

        $namaBulanIndonesia = isset($bulanIndonesia[$bulan]) ? $bulanIndonesia[$bulan] : $bulan;

        if ($request->has('cetak_pdf')) {
            $pdf = Pdf::loadView('content.laporan.laporanPDF', [
                'totalSuratMasuk' => $totalSuratMasuk,
                'totalSuratKeluar' => $totalSuratKeluar,
                'dataSurat' => $dataSurat,
                'namaBulanIndonesia' => $namaBulanIndonesia,
                'tahun' => $tahun
            ])->setPaper('a4', 'landscape');

            return $pdf->download('laporan Surat Masuk & Keluar_'.$namaBulanIndonesia.'_'.$tahun.'.pdf');
        }


        $title = 'Laporan';

        return view('content.laporan.index', compact('totalSuratMasuk', 'totalSuratKeluar', 'dataSurat', 'klasifikasi_arsip', 'namaBulanIndonesia', 'tahun', 'bulan', 'title'));
    }



    public function cetak(Request $request)
    {
        $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');
    $arsip = $request->input('arsip');

    // $klasifikasi_arsip = klasifikasi_arsip::all();

    // Mulai query tanpa langsung dieksekusi
    $suratMasuk = surat_masuk::query();
    $suratKeluar = surat_keluar::query();

    // Terapkan filter bulan
    if ($bulan) {
        $suratMasuk->whereMonth('tgl_surat', $bulan);
        $suratKeluar->whereMonth('tgl_surat', $bulan);
    }

    // Terapkan filter tahun
    if ($tahun) {
        $suratMasuk->whereYear('tgl_surat', $tahun);
        $suratKeluar->whereYear('tgl_surat', $tahun);
    }

    // Terapkan filter arsip
    if ($arsip) {
        $suratMasuk->where('kode_arsip', $arsip);
        $suratKeluar->where('kode_arsip', $arsip);
    }

    // Jika tidak ada filter, gunakan bulan & tahun saat ini
    if (!$bulan && !$tahun && !$arsip) {
        $suratMasuk->whereMonth('tgl_surat', date('m'))->whereYear('tgl_surat', date('Y'));
        $suratKeluar->whereMonth('tgl_surat', date('m'))->whereYear('tgl_surat', date('Y'));
    }
    $queryMasuk = $suratMasuk->select(
        DB::raw("CONCAT('M', no_suratmasuk) as id"),
        'tgl_surat',
        'no_suratmasuk as no_surat',
        'perihal',
        'asal_surat',
        'kode_arsip',
        'lampiran_pdf',
        'lampiran_gambar',
        'nip',
        DB::raw("'Masuk' as jenis")
    )
    ->with(['petugas', 'klasifikasi_arsip']);

// Ambil data surat keluar
$queryKeluar = $suratKeluar->select(
        DB::raw("CONCAT('K', no_suratkeluar) as id"),
        'tgl_surat',
        'no_suratkeluar as no_surat',
        'perihal',
        'tujuan',
        'kode_arsip',
        'lampiran_pdf',
        'lampiran_gambar',
        'nip',
        DB::raw("'Keluar' as jenis")
    )
    ->with(['petugas']);

// Gabungkan kedua query dengan UNION dan order by tanggal
$dataSurat = $queryMasuk->union($queryKeluar)
    ->orderBy('tgl_surat', 'desc')
    ->paginate(10);

$bulanIndonesia = [
    'January' => 'Januari',
    'February' => 'Februari',
    'March' => 'Maret',
    'April' => 'April',
    'May' => 'Mei',
    'June' => 'Juni',
    'July' => 'Juli',
    'August' => 'Agustus',
    'September' => 'September',
    'October' => 'Oktober',
    'November' => 'November',
    'December' => 'Desember'
];
    $totalSuratMasuk = $suratMasuk->count();
    $totalSuratKeluar = $suratKeluar->count();

    $month = $bulan ?? now()->format('m');
        $month = \Carbon\Carbon::createFromFormat('m', $month);
        $bulan = $month->translatedFormat('F');

        $year = $tahun ?? now()->format('Y');
        $year = \Carbon\Carbon::createFromFormat('Y', $year);
        $tahun = $year->translatedFormat('Y');

    $namaBulanIndonesia = isset($bulanIndonesia[$bulan]) ? $bulanIndonesia[$bulan] : $bulan;


        $namaBulanIndonesia = isset($bulanIndonesia[$bulan]) ? $bulanIndonesia[$bulan] : '';
        dd($dataSurat);
        return view('content.laporan.laporanPDF', compact(
            'totalSuratMasuk',
            'totalSuratKeluar',
            'dataSurat',
            'namaBulanIndonesia',
            'tahun'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
