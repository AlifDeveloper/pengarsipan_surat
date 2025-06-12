<div id="backdrop"
    class="hidden fixed inset-0 w-screen h-screen z-50 bg-black/20 bg-opacity-30 backdrop-blur-md transition-opacity duration-300">
</div>

<div id="logout-modal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center w-full h-screen">
    <div class="relative p-4 w-full max-w-md bg-white rounded-lg shadow-sm">
        <div class="p-4 md:p-5 text-center">
            <img src="{{ asset('svg/logout.svg') }}" alt="" class="mx-auto mb-4 text-gray-400 w-35 h-35">
            <h3 class="mb-5 text-2xl font-semibold text-gray-500">Apakah Anda yakin ingin <br>keluar?</h3>
            <a href="{{ route('logout') }}"
                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center cursor-pointer">
                Ya
            </a>
            <button type="button" id="cancel-logout"
                class="py-2.5 px-5 ms-3 text-sm font-medium text-red1 focus:outline-none bg-white rounded-lg border border-red1 hover:bg-gray-100 hover:text-red1 focus:z-10 focus:ring-4 focus:ring-gray-100 cursor-pointer">
                Tidak
            </button>
        </div>
    </div>
</div>
