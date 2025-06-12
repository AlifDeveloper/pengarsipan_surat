@extends('components.layouts.main')
@section('content')
    <div class="bg-transparent rounded-lg mb-4">
        <h2 class="text-[26px] font-bold">Surat Masuk</h2>
        <p class="text-gray-500 text-sm"><span class='text-blue'>Beranda</span> / <span class='text-blue'>Pengarsipan</span> /
            Edit surat masuk</p>
    </div>

    <!-- Search Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-4">

        <div class="p-4">
            <div class="block overflow-visible">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-blue" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                    </svg>
                    <div>
                        <h3 class="text-md font-bold text-slate-800">Form Edit Arsip Surat Masuk</h3>
                        <p class="text-slate-500 text-sm">Anda dapat edit data surat masuk pada form dibawah ini.</p>
                    </div>
                </div>
                <hr class="h-px bg-secondary border-1 mt-2">
                <div class="relative block w-full overflow-hidden !overflow-x-hidden !overflow-y-visible bg-transparent">
                    <div role="tabpanel" data-value="card">
                        <form class="mt-2 flex flex-col" action="{{ route('surat-masuk.update', $suratMasuk->no_suratmasuk) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <label class="block mb-1 text-sm text-slate-600 mt-4">
                                Klasifikasi Arsip
                            </label>
                            <select name="kode_arsip" id=""
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-20 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                                <option value="" disabled>-- Pilih Arsip --</option>
                                @foreach ($klasifikasi as $item)
                                    <option value="{{ $item->kode_arsip }}" {{ $suratMasuk->kode_arsip == $item->kode_arsip ? 'selected' : '' }}>[{{ $item->kode_arsip }}] {{ $item->nama_arsip }}</option>
                                @endforeach
                            </select>

                            <div class="flex">
                                <div class="w-full md:w-6/12 mr-4">
                                    <label class="block mb-1 text-sm text-slate-600 mt-4">
                                        Tanggal Masuk Surat
                                    </label>
                                    <input type="date" name="tgl_surat" value="{{ $suratMasuk->tgl_surat }}"
                                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                        placeholder="DD/MM/YY" />
                                </div>
                                <div class="w-full md:w-6/12">
                                    <label class="block mb-1 text-sm text-slate-600 mt-4">
                                        Nomor Surat
                                    </label>
                                    <input type="text" name="no_suratmasuk" value="{{ $suratMasuk->no_suratmasuk }}"
                                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                        placeholder="Masukan nomor surat" />
                                </div>
                            </div>

                            <div class="flex">
                                <div class="w-full md:w-6/12 mr-4">
                                    <label class="block mb-1 text-sm text-slate-600 mt-4">
                                        Perihal Surat
                                    </label>
                                    <input type="text" name="perihal" value="{{ $suratMasuk->perihal }}"
                                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-20 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                        placeholder="Masukan perihal surat" />
                                </div>
                                <div class="w-full md:w-6/12">
                                    <label class="block mb-1 text-sm text-slate-600 mt-4">
                                        Asal Surat
                                    </label>
                                    <input type="text" name="asal_surat" value="{{ $suratMasuk->asal_surat }}"
                                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                        placeholder="Masukan asal surat" />
                                </div>
                            </div>

                            <label class="mt-4 block mb-1 text-sm text-slate-600">
                                Penanggung Jawab
                            </label>
                            <select name="nip" id=""
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-20 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                                <option value="" disabled>-- Pilih Penanggung Jawab --</option>
                                @foreach ($petugas as $item)
                                    <option value="{{ $item->nip }}" {{ $suratMasuk->nip == $item->nip ? 'selected' : '' }}>{{ $item->jabatan }}</option>
                                @endforeach
                            </select>

                            {{-- checkbox Disposisi  --}}
                            <label class="flex items-center mt-4 ml-4">
                                <input type="checkbox" id="toggleDisposisi" name="disposisi" class="mr-2"
                                    {{ old('disposisi', $disposisi ? 'checked' : '') }}>
                                <span class="text-sm text-gray-600">Tambahkan ke Disposisi</span>
                            </label>

                            <div id="disposisiForm" class="{{ isset($disposisi) ? '' : 'hidden' }} mt-4">
                                {{-- Tanggal Keluar Surat --}}
                                <label class="block mb-1 text-sm text-slate-600 mt-4">
                                    Tanggal Keluar Surat
                                </label>
                                <input type="date" name="tgl_surat_keluar" value="{{ $disposisi->tgl_diterima ?? '' }}"
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                    placeholder="DD/MM/YY" />
                                <input type="text" name="no_disposisi" value="{{ $disposisi ? $disposisi->no_disposisi : '' }}" hidden id="">
                                {{-- Diteruskan & Sifat Surat --}}
                                <div class="flex">
                                    <div class="w-full md:w-6/12 mr-4">
                                        <label class="block mb-1 text-sm text-slate-600 mt-4">
                                            Diteruskan Kepada
                                        </label>
                                        <input type="text" name="diteruskan" value="{{ $disposisi->tujuan_surat ?? '' }}"
                                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-20 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                            placeholder="Masukan diteruskan surat" />
                                    </div>
                                    <div class="w-full md:w-6/12">
                                        <label class="block mb-1 text-sm text-slate-600 mt-4">
                                            Sifat Surat
                                        </label>
                                        <select name="sifat" id=""
                                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-20 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                                            <option value="" disabled>-- Pilih Sifat --</option>
                                            @foreach ($sifat as $item)
                                                <option value="{{ $item->kode_sifat }}"
                                                    {{ isset($disposisi) && $disposisi->kode_sifat == $item->kode_sifat ? 'selected' : '' }}>
                                                    {{ $item->nama_sifat }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <label class="mt-4 block mb-1 text-sm text-slate-600">
                                Tambahkan Lampiran
                            </label>

                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 px-4 transition-all"
                                    id="dropzone">

                                    <!-- Container Preview (Hidden Awal) -->
                                    <div id="dropzone-preview" class="hidden flex items-center w-full">
                                        <div class="flex flex-col">
                                            <img id="preview-image" class="w-24 h-24 object-cover rounded-md mr-4">
                                            <div id="dropzone-text-updated" class="flex flex-col">
                                                <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">File
                                                        uploaded:</span></p>
                                                <p id="file-name" class="text-xs text-gray-500 truncate w-40"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Container Awal (Tengah) -->
                                    <div id="dropzone-text" class="flex flex-col items-center transition-all">
                                        <svg class="w-8 h-8 mb-2 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                                upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG (Max 2MB)</p>
                                    </div>

                                    <input id="dropzone-file" name="lampiran_gambar" type="file" class="hidden"
                                        accept="image/png, image/jpeg, image/jpg" />
                                </label>
                            </div>

                            @if($suratMasuk->lampiran)
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 font-semibold">Lampiran saat ini:</p>
                                <div class="mt-2 flex items-center">
                                    <img src="{{ asset('storage/' . $suratMasuk->lampiran) }}" alt="Current attachment" class="w-24 h-24 object-cover rounded-md">
                                    <p class="ml-3 text-sm text-gray-500">Upload file baru untuk mengganti lampiran ini</p>
                                </div>
                            </div>
                            @endif

                            <div class="flex justify-end">
                                <div class="w-full md:w-1/12 mr-4">
                                    <a href="{{ route('surat-masuk.index') }}"
                                        class="flex mb-1  mt-4 text-red1 px-1 py-1 border border-red1  cursor-pointer rounded-md text-sm">
                                        <svg class="w-6 h-6 text-red1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>

                                        <span class="ml-2">Batal</span>
                                    </a>
                                </div>
                                <div class="w-full md:w-2/12">
                                    <button type="submit"
                                        class="flex mb-1  mt-4 bg-blue-500 text-white px-1 py-1  cursor-pointer rounded-md text-sm">
                                        <svg class="w-6 h-6 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                d="M11 16h2m6.707-9.293-2.414-2.414A1 1 0 0 0 16.586 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7.414a1 1 0 0 0-.293-.707ZM16 20v-6a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v6h8ZM9 4h6v3a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V4Z" />
                                        </svg>

                                        <span class="ml-2">Simpan</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection

@section('scripts')
    <script src="node_modules/@material-tailwind/html@latest/scripts/dialog.js"></script>
    <script>
        function toggleDropdown() {
            document.getElementById("dropdown").classList.toggle("hidden");
        }
    </script>

    <script>
        // Enhanced dropzone file preview script
        const dropzoneFile = document.getElementById('dropzone-file');
        const dropzonePreview = document.getElementById('dropzone-preview');
        const dropzoneText = document.getElementById('dropzone-text');
        const previewImage = document.getElementById('preview-image');
        const fileName = document.getElementById('file-name');

        dropzoneFile.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                // Show preview container, hide default text
                dropzonePreview.classList.remove('hidden');
                dropzoneText.classList.add('hidden');

                // Set file name
                fileName.textContent = file.name;

                // Create and display image preview
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImage.src = event.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                // Hide preview container, show default text
                dropzonePreview.classList.add('hidden');
                dropzoneText.classList.remove('hidden');
            }
        });
    </script>

    <script>
        // Set up the initial state of the disposisi form
        document.addEventListener('DOMContentLoaded', function() {
            const toggleCheckbox = document.getElementById('toggleDisposisi');
            const disposisiForm = document.getElementById('disposisiForm');

            // Initialize based on checkbox state (which is set by Blade)
            if (toggleCheckbox.checked) {
                disposisiForm.classList.remove('hidden');
            } else {
                disposisiForm.classList.add('hidden');
            }

            // Add event listener for future changes
            toggleCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    disposisiForm.classList.remove('hidden');
                } else {
                    disposisiForm.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
