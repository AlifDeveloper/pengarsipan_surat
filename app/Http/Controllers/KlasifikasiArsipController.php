<?php

namespace App\Http\Controllers;

use App\Models\klasifikasi_arsip;
use Illuminate\Http\Request;

class KlasifikasiArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchKode = $request->input('search_kode');
        $searchNama = $request->input('search_nama');


        $arsip = klasifikasi_arsip::when($searchKode, function ($query) use ($searchKode) {
                return $query->where('kode_arsip', 'like', "%$searchKode%");
            })
            ->when($searchNama, function ($query) use ($searchNama) {
                return $query->where('nama_arsip', 'like', "%$searchNama%");
            })
            ->paginate(10); // Sesuaikan jumlah per halaman
        
        $title = 'Klasifikasi Arsip';
        return view('content.klasifikasiArsip.index', compact('arsip', 'title'));
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
        $request->validate([
            'kode_arsip' => 'required',
            'nama_arsip' => 'required'
        ]);

        $data = new klasifikasi_arsip;
        $data->kode_arsip = $request->kode_arsip;
        $data->nama_arsip = $request->nama_arsip;
        $data->save();

        return redirect(route('klasifikasi-arsip.index'))->with('success', 'Klasifikasi arsip berhasil disimpan')->withHeaders([
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
