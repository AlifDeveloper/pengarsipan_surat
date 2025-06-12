@include('content.klasifikasiArsip.create')
@extends('components.layouts.main')
@section('content')
    <div class="bg-transparent rounded-lg mb-4">
        <h2 class="text-[26px] text-gray-800 font-bold ">Klasifikasi Arsip</h2>
        <p class="text-gray-500 text-sm"><span class="text-blue">Beranda</span> / Klasifikasi arsip</p>
    </div>

    <!-- Search Section -->
    <form action={{ route('klasifikasi-arsip.index') }} method="GET">
        <div class="bg-white p-6 rounded-lg shadow-md mt-4">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-blue" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>

                <h3 class="font-bold text-gray-800 text-md">Cari Klasifikasi Arsip</h3>
            </div>
            <div class="flex">
                <div class="w-full md:w-4/12 mr-4">
                    <label class="block mb-1 text-sm  mt-4 font-medium">
                        Cari kode arsip
                    </label>
                    <input type="text" name="search_kode" value="{{ request('search_kode') }}"
                        class="w-full bg-transparent placeholder:text-slate-400 text-gray1 text-sm border border-slate-200 rounded-md pl-3 pr-20 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        placeholder="000" />
                </div>
                <div class="w-full md:w-5/12">
                    <label class="block mb-1 text-sm text-slate-800 mt-4 font-medium">
                        Cari nama arsip
                    </label>
                    <input type="text" name="search_nama" value="{{ request('search_nama') }}"
                        class="w-full bg-transparent placeholder:text-slate-400 text-gray1 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        placeholder="Umum" />
                </div>
                <div class="w-full md:w-2/12 mt-10 ml-16 text-sm">
                    <button type="button" onclick="resetForm()"
                        class="border cursor-pointer border-red1 text-red1 px-3 py-2 rounded-md">Reset</button>
                    {{-- <button onclick="location.href='{{ route('klasifikasi-arsip.index') }}'"
                        class="border cursor-pointer border-red1 text-red1 px-3 py-2 rounded-md">Reset</button> --}}
                    <button class="bg-blue-500 cursor-pointer text-white px-3 py-2 rounded-md">Tampilkan</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Table Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-4">
        <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
            <div class="flex items-center space-x-2">
                <svg class="w-6 h-6 text-blue" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 3v4a1 1 0 0 1-1 1H5m4 8h6m-6-4h6m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                </svg>

                <div>
                    <h3 class="text-md font-bold text-gray-800">Data Klasifikasi Arsip</h3>
                    <p class="text-slate-500 text-sm">Berikut ini adalah data klasifikasi arsip yang tersedia.</p>
                </div>
            </div>
            <div class="ml-3">
                <div class="relative">
                    <a data-modal-toggle = "add-data-modal"
                        class="bg-blue-500 text-white px-3 cursor-pointer py-2 rounded-md text-sm">
                        + Tambah Klasifikasi Baru
                    </a>
                </div>
            </div>
        </div>
        <div class="border rounded-lg border-slate-50 overflow-hidden">
            <table class="w-full text-left table-auto min-w-max text-xs ">
                <thead>
                    <tr>
                        <th
                            class="p-4 w-12 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                            <p class="flex items-center gap-2  font-medium leading-none  ">
                                No
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>

                        <th
                            class="p-4 w-80 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                            <p class="flex items-center justify-between gap-2  font-medium leading-none  ">
                                Kode arsip
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <th
                            class="p-4 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                            <p class="flex items-center justify-between gap-2  font-medium leading-none  ">
                                Nama arsip
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($arsip as $index => $item)
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 border border-slate-200 text-center">
                                <p class="block  text-slate-800">
                                    {{ ($arsip->currentPage() - 1) * $arsip->perPage() + $loop->iteration }}
                                </p>
                            </td>
                            <td class="p-4 border border-slate-200">
                                <p class="block  text-slate-800">
                                    {{ $item->kode_arsip }}
                                </p>
                            </td>
                            <td class="p-4 border border-slate-200">
                                <p class="block  text-slate-800">
                                    {{ $item->nama_arsip }}
                                </p>
                            </td>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-4 border border-slate-200 text-center text-gray-500">Data tidak
                                tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex justify-between items-center mt-4 text-blue">
            <a href="{{ $arsip->previousPageUrl() }}"
                class="flex items-center justify-center rounded-md border border-blue py-2 px-3 text-center text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue hover:border-blue {{ $arsip->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="ml-2">Prev</span>
            </a>
            <div class="flex space-x-2">
                @for ($i = 1; $i <= $arsip->lastPage(); $i++)
                    <a href="{{ $arsip->url($i) }}"
                        class="min-w-9 rounded-md py-2 px-3 text-center text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue
                    {{ $arsip->currentPage() == $i ? 'bg-blue text-white' : 'border border-slate-300' }}">
                        {{ $i }}
                    </a>
                @endfor
            </div>

            <a href="{{ $arsip->nextPageUrl() }}"
                class="flex items-center justify-center rounded-md border border-blue py-2 px-3 text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue hover:border-blue
                {{ $arsip->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                <span class="mr-2">Next</span>
                <svg class="w-2.5 h-2.5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
            </a>
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
        function resetForm() {
            // Reset form dan redirect ke halaman tanpa parameter
            window.location.href = '{{ auth()->user()->level_user == 'kades' ? '' : route('klasifikasi-arsip.index') }}';
        }
    </script>
@endsection
