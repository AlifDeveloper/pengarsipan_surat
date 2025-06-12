<aside class="w-56 bg-white p-4 shadow-lg flex flex-col">
    <div class="flex items-center space-x-2">
        <img src={{ asset('images/logo.png') }} alt="Logo" class="h-8">
        <div class="text-[14px]">
            <span class="font-bold">Kalurahan Karangrejek</span>
            <p class="font-semibold text-gray1">Kapanewon Wonosari</p>
        </div>

    </div>
    <hr class="h-px mt-3 bg-gray-200 border-1">
    <nav class="mt-6 flex-1 text-[14px]">
        <ul>
            <li class="{{ auth()->user()->level_user == 'kades' ? 'hidden' : '' }}">
                <a href="{{ route('klasifikasi-arsip.index') }}" class="flex items-center space-x-2 p-2 {{ Request::routeIs('klasifikasi-arsip.index') ? 'bg-blue-500 text-white rounded-md' : '' }} ">

                    <svg class="w-6 h-6 {{ Request::routeIs('klasifikasi-arsip.index') ? 'text-primary' : 'text-gray-800' }} " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 8H4m0-2v13a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1h-5.032a1 1 0 0 1-.768-.36l-1.9-2.28a1 1 0 0 0-.768-.36H5a1 1 0 0 0-1 1Z"/>
                    </svg>
                    <span class="font-semibold">Klasifikasi Arsip</span>
                </a>
            </li>
            <li>
                <button class="flex cursor-pointer items-center space-x-2 p-2 w-full text-left hover:bg-gray-200 rounded-md focus:outline-none" onclick="toggleDropdown()">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 8H4m8 3.5v5M9.5 14h5M4 6v13a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1h-5.032a1 1 0 0 1-.768-.36l-1.9-2.28a1 1 0 0 0-.768-.36H5a1 1 0 0 0-1 1Z"/>
                      </svg>

                    <span class="font-semibold flex-1">Pengarsipan</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                     </svg>
                </button>
                <ul id="dropdown" class="pl-4 mt-1 space-y-1">
                    <li class=" hover:bg-gray-200 rounded-md">
                        <a href="{{ auth()->user()->level_user == 'kades' ? route('pengarsipan-surat-masuk.index') : route('surat-masuk.index') }}"
                            class="flex items-center space-x-2 p-2 {{ Request::routeIs('surat-masuk.index') || Request::routeIs('surat-masuk.create') || Request::routeIs('surat-masuk.edit') || Request::routeIs('pengarsipan-surat-masuk.index') ? 'bg-blue-500 text-white rounded-md' : '' }}">
                            <svg class="w-6 h-6 {{ Request::routeIs('surat-masuk.index') || Request::routeIs('surat-masuk.create') || Request::routeIs('surat-masuk.edit') || Request::routeIs('pengarsipan-surat-masuk.index') ? 'text-white rounded-md' : 'text-gray-800' }} " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m4 8h6m-6-4h6m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z"/>
                              </svg>

                            <span class="font-semibold">Surat Masuk</span>
                        </a>
                    </li>
                    <li class=" hover:bg-gray-200 rounded-md">
                        <a href="{{ auth()->user()->level_user == 'kades' ? route('pengarsipan-surat-keluar.index') : route('surat-keluar.index') }}"
                            class="flex items-center space-x-2 p-2 {{ Request::routeIs('surat-keluar.index') || Request::routeIs('surat-keluar.create') || Request::routeIs('surat-keluar.edit') || Request::routeIs('pengarsipan-surat-keluar.index') ? 'bg-blue-500 text-white rounded-md' : '' }}">
                            <svg class="w-6 h-6 {{ Request::routeIs('surat-keluar.index') || Request::routeIs('surat-keluar.create') || Request::routeIs('surat-keluar.edit') || Request::routeIs('pengarsipan-surat-keluar.index') ? 'text-white rounded-md' : 'text-gray-800' }}  " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m4 8h6m-6-4h6m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z"/>
                              </svg>

                            <span class="font-semibold">Surat Keluar</span>
                        </a>
                    </li>
                    <li class=" hover:bg-gray-200 rounded-md">
                        <a href="{{ auth()->user()->level_user == 'kades' ? route('pengarsipan-disposisi.index') : route('disposisi.index') }}"
                            class="flex items-center space-x-2 p-2 {{ Request::routeIs('disposisi.index') || Request::routeIs('disposisi.create') || Request::routeIs('pengarsipan-disposisi.index') ? 'bg-blue-500 text-white rounded-md' : '' }}">
                            <svg class="w-6 h-6 {{ Request::routeIs('disposisi.index') || Request::routeIs('disposisi.create') || Request::routeIs('pengarsipan-disposisi.index') ? ' text-white rounded-md' : 'text-gray-800' }} " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                              </svg>

                            <span class="font-semibold">Disposisi</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ auth()->user()->level_user == 'kades' ? route('laporan-surat.index') : route('laporan.index') }}" 
                class="flex items-center space-x-2 p-2 {{ Request::routeIs('laporan.index') || Request::routeIs('laporan-surat.index') ? 'bg-blue-500 text-white rounded-md' : '' }} ">
                    <svg class="w-6 h-6 {{ Request::routeIs('laporan.index') || Request::routeIs('laporan-surat.index') ? 'text-primary' : 'text-gray-800' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z"/>
                      </svg>
                    <span class="font-semibold">Laporan Surat</span>
                </a>
            </li>
        </ul>
    </nav>
    <hr class="h-px bg-gray-200 border-0">
</aside>
