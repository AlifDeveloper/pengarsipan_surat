@include('components.modal.detail_file')
@extends('components.layouts.main')
@section('content')
    <div class="bg-transparent rounded-lg mb-4">
        <h2 class="text-[26px] font-bold">Disposisi</h2>
        <p class="text-gray-500 text-sm"><span class='text-blue'>Beranda</span> / <span class='text-blue'>Pengarsipan</span> /
            Disposisi</p>
    </div>

    <!-- Search Section -->
    <form action="{{ auth()->user()->level_user == 'kades' ? route('pengarsipan-disposisi.index') : route('disposisi.index') }}" method="GET">
        <div class="bg-white p-6 rounded-lg shadow-md mt-4">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-blue" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
                <h3 class="font-bold text-md">Cari Surat Masuk</h3>
            </div>
            <div class="flex flex-wrap">
                <div class="w-full md:w-4/12 mr-4">
                    <label class="block mb-1 text-sm mt-4 font-medium">
                        Cari Bulan
                    </label>
                    <select name="bulan" class="w-full text-sm bg-transparent border text-gray1 border-slate-200 rounded-md px-3 py-2">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach (range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-4/12 mr-4">
                    <label class="block mb-1 text-sm mt-4 font-medium">
                        Cari Tahun
                    </label>
                    <select name="tahun" class="w-full text-sm bg-transparent border text-gray1 border-slate-200 rounded-md px-3 py-2">
                        <option value="">-- Pilih Tahun --</option>
                        @for ($year = date('Y'); $year >= date('Y') - 5; $year--)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="w-full md:w-2/12 mt-10 ml-16 text-sm">
                    <button type="button" onclick="resetForm()"
                        class="border border-red1 text-red1 cursor-pointer px-3 py-2 rounded-md">Reset</button>
                    <button type="submit"
                        class="bg-blue-500 text-white px-3 py-2 rounded-md cursor-pointer">Tampilkan</button>
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
                    <h3 class="text-md font-bold text-slate-800">Data Disposisi</h3>
                    <p class="text-slate-500 text-sm">Berikut adalah data disposisi yang tersedia.</p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <div class="border rounded-lg border-slate-50 overflow-hidden">
                <table class="min-w-full text-left table-auto  text-xs ">
                    <thead>
                        <tr>
                            <th
                                class="p-2 w-12 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center gap-2  font-medium leading-none ">
                                    No
                                </p>
                            </th>

                            <th
                                class="p-2 w-40 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none">
                                    Tanggal Diterima
                                </p>
                            </th>
                            <th
                                class="p-2 w-30 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none ">
                                    Nomor Surat
                                </p>
                            </th>
                            <th
                                class="p-2 w-60 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none">
                                    Perihal Surat
                                </p>
                            </th>
                            <th
                                class="p-2 w-30 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none">
                                    Pengisi Disposisi
                                </p>
                            </th>
                            <th
                                class="p-2 w-40 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none">
                                    Diteruskan kepada
                                </p>
                            </th>
                            <th
                                class="p-2 w-35 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p
                                    class="flex items-center text-center justify-between gap-2  font-medium leading-non">
                                    Sifat Surat
                                </p>
                            </th>
                            <th
                                class="p-2 w-30 text-center transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none">
                                    Lampiran
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($disposisi as $index => $item)
                            <tr class="hover:bg-slate-50">
                                <td class="p-2 border border-slate-200 text-center">
                                    <p class="block  text-slate-800">
                                        {{ ($disposisi->currentPage() - 1) * $disposisi->perPage() + $loop->iteration }}
                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        {{ $item->tgl_diterima }}
                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        {{ $item->no_suratmasuk }}
                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        {{ $item->perihal }}
                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        {{ $item->petugas->jabatan }}
                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        {{ $item->tujuan_surat }}
                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p
                                        class="block text-center
                                        {{ $item->sifat_arsip->nama_sifat == 'Segera' ? 'bg-sgr' : '' }}
                                        {{ $item->sifat_arsip->nama_sifat == 'Sangat Segera' ? 'bg-ss' : '' }}
                                        {{ $item->sifat_arsip->nama_sifat == 'Rahasia' ? 'bg-rs' : '' }}
                                        rounded-lg text-primary">
                                        {{ $item->sifat_arsip->nama_sifat }}
                                    </p>
                                </td>

                                {{-- modal lihat arsip --}}
                                <td class="p-2 border text-center border-slate-200">
                                    <p class="block text-center text-slate-800">
                                        {{-- <a href="javascript:void(0);" onclick="printImage('{{ asset('storage/' . $item->lampiran_gambar) }}')" --}}
                                        <a href="{{ auth()->user()->level_user == 'kades' ? route('pengarsipan.disposisi.cetak', $item->no_disposisi) : route('disposisi.cetak', $item->no_disposisi) }}"
                                            class="flex text-center bg-blue-500 text-white px-1 py-1 rounded-lg cursor-pointer rounded-md text-xs">
                                            <svg class="w-4 h-4 text-primary" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M6 9V3h12v6m3 4v8H3v-8h18Zm-12 4h6" />
                                            </svg>
                                            <span class="ml-2">Print</span>
                                        </a>
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="p-4 border border-slate-200 text-center text-gray-500">Data
                                    tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-between items-center mt-4 text-blue">
            <a href="{{ $disposisi->previousPageUrl() }}"
                class="flex items-center justify-center rounded-md border border-blue py-2 px-3 text-center text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue hover:border-blue {{ $disposisi->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="ml-2">Prev</span>
            </a>
            <div class="flex space-x-2">
                <div class="flex space-x-2">
                    @for ($i = 1; $i <= $disposisi->lastPage(); $i++)
                        <a href="{{ $disposisi->url($i) }}"
                            class="min-w-9 rounded-md py-2 px-3 text-center text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue
                        {{ $disposisi->currentPage() == $i ? 'bg-blue text-white' : 'border border-slate-300' }}">
                            {{ $i }}
                        </a>
                    @endfor
                </div>
            </div>
            <a href="{{ $disposisi->nextPageUrl() }}"
                class="flex items-center justify-center rounded-md border border-blue py-2 px-3 text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue hover:border-blue
                {{ $disposisi->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
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
                confirmButtonText: 'Kembali ke arsip',
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
            window.location.href = '{{ auth()->user()->level_user == 'kades' ? route('pengarsipan-disposisi.index') : route('disposisi.index') }}';
        }
    </script>
@endsection
