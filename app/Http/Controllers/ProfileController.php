<?php

namespace App\Http\Controllers;

use App\Models\kades;
use App\Models\petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->guard('petugas')->check()) {
            $user = petugas::where('id_users', auth()->guard('petugas')->id())->first();
        } else {
            $user = kades::where('id_users', auth()->guard('kades')->id())->first();
        }
        $user_info = User::where('id', $user->id_users)->first();
        $title = 'Profile';
        return view('content.profile.profile', compact('user', 'title', 'user_info'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
        }

        // Simpan foto baru
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        // Update database
        $user->update(['profile_picture' => $path]);

        return response()->json([
            'success' => true,
            'image_url' => asset('storage/' . $path)
        ]);
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
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'nip' => 'required',
            'nama' => 'required',
            'tgl_lahir' => 'required|date',
            'jabatan' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        if (auth()->guard('petugas')->check()) {
            $pengguna = petugas::findOrFail($id);
            $pengguna->nip = $request->nip;
            $pengguna->nama = $request->nama;
            $pengguna->tgl_lahir = $request->tgl_lahir;
            $pengguna->jabatan = $request->jabatan;
            $pengguna->alamat = $request->alamat;
            $pengguna->no_telp = $request->no_telp;
            $pengguna->id_users = auth()->user()->id;
            $pengguna->save();

        } else {
            $pengguna = kades::findOrFail($id);
            $pengguna->nip = $request->nip;
            $pengguna->nama = $request->nama;
            $pengguna->tgl_lahir = $request->tgl_lahir;
            $pengguna->jabatan = $request->jabatan;
            $pengguna->alamat = $request->alamat;
            $pengguna->no_telp = $request->no_telp;
            $pengguna->id_users = auth()->user()->id;
            $pengguna->save();
        }

        $user = User::findOrFail($pengguna->id_users);
        $user->username = $request->username;
        $user->password = $request->password;
        $user->update();

        if (auth()->guard('kades')->check()) {
            return redirect(route('profile-info.index'))->with('success', 'Profile Anda berhasil diperbarui.')->withHeaders([
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
        } else {
            return redirect(route('profile.index'))->with('success', 'Profile Anda berhasil diperbarui.')->withHeaders([
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
