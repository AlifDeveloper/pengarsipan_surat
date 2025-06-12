    @extends('components.layouts.main')
    @section('content')
        <div class="bg-transparent rounded-lg mb-4">
            <h2 class="text-[26px] font-bold">Profil Petugas</h2>
            <p class="text-gray-500 text-sm">Profil Petugas</p>
        </div>

        <div class="flex">
            <!-- Profile Content -->
            <div class="flex-1 relative flex flex-col rounded-xl bg-primary p-6 text-sm">
                <h4 class="block text-xl font-bold">
                    Profil Petugas
                </h4>
                <p class="font-light">
                    Anda dapat mengubah data dibawah ini.
                </p>
                <hr class="h-px mt-4 bg-gray-300 border-0 mb-4">
                <form method="POST" action="{{ auth()->user()->level_user == 'kades' ? route('profile-info.update', $user->nip) : route('profile.update', $user->nip) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-1 flex flex-col gap-6">
                        <div>
                            <label class="block mb-2 text-sm text-slate-600">Username</label>
                            <input type="text" name="username" value="{{ old('username', $user_info->username) }}"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-slate-600">Password</label>
                            <input type="password" name="password" value="{{ old('password', $user_info->password) }}"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-slate-600">NIP</label>
                            <input type="text" name="nip" value="{{ old('nip', $user->nip) }}"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-slate-600">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-slate-600">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $user->tgl_lahir) }}"
                                class="w-full bg-transparent text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-slate-600">Jabatan</label>
                            <input type="text" name="jabatan" value="{{ old('jabatan', $user->jabatan) }}"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-slate-600">No Telepon</label>
                            <input type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-slate-600">Alamat</label>
                            <input type="text" name="alamat" value="{{ old('alamat', $user->alamat) }}"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2" />
                        </div>
                    </div>

                    <div class="p-4 flex plt-0 justify-end">
                        <a href="javascript:history.back()"
                            class="w-1/8 flex items-center justify-center mr-6 text-red1 border border-red1 py-2 rounded-md cursor-pointer">
                            <svg class="w-6 h-6 text-red1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="ml-4">Batal</span>
                        </a>
                        <button type="submit"
                            class="w-1/6 flex bg-blue text-white items-center justify-center py-2 rounded-md cursor-pointer">
                            <svg class="w-6 h-6 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="M11 16h2m6.707-9.293-2.414-2.414A1 1 0 0 0 16.586 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7.414a1 1 0 0 0-.293-.707ZM16 20v-6a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v6h8ZM9 4h6v3a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V4Z" />
                            </svg>
                            <span class="ml-4">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Profile Picture Section -->
            <div class="w-64 bg-white p-6 shadow-md ml-6 rounded-lg max-h-64">
                <h3 class="text-lg font-semibold text-gray-600">Foto Profile</h3>
                <div class="mt-4 flex flex-col items-center">
                    <img
                        id="profileImage"
                        src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile.png') }}"
                        {{-- src="{{ asset('images/profile.png') }}"  --}}
                        class="h-24 w-24 rounded-full">

                    <input type="file" id="profileInput" name="profilePicture" class="hidden" accept="image/*">

                    <button
                        onclick="document.getElementById('profileInput').click()"
                        class="mt-6 flex bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">
                        <svg class="w-6 h-6 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0-12 4 4m-4-4L8 8" />
                        </svg>
                        <span>Upload Foto</span>
                    </button>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Kembali',
                    confirmButtonColor: '#3085d6',
                    customClass: {
                        popup: 'custom-popup',
                        title: 'custom-title',
                        htmlContainer: 'custom-text',
                        confirmButton: 'custom-button'
                    }
                });
            </script>
        @endif

        <script>
            document.getElementById('profileInput').addEventListener('change', function(event) {
                let formData = new FormData();
                formData.append('profile_picture', event.target.files[0]);

                fetch("{{ auth()->user()->level_user == 'kades' ? route('profile.kades.upload') : route('profile.upload') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('profileImage').src = data.image_url;
                    } else {
                        alert("Gagal mengupload gambar");
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        </script>
    @endsection
