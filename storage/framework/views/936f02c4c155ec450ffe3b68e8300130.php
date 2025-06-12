<div id="modal-detail" class="hidden fixed inset-0 bg-black/20 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-4 rounded-lg shadow-lg w-96 z-50">
        <h3 class="text-lg font-semibold mb-2">Lampiran Arsip</h3>
        <div class="flex">
            
            <div id="pdf-container" class="mr-2 text-sm mb-2 hidden">
                <a id="pdf-link" href="#" target="_blank" class="bg-blue flex text-white px-3 py-2 rounded-lg ">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                    </svg>
                    <span class="ml-2">Lihat PDF</span>
                </a>
            </div>

            
            <div id="gambar-container" class="text-sm mb-2 hidden">
                <a id="gambar-link" href="#" target="_blank" class="flex bg-blue text-white px-3 py-2 rounded-lg">
                    <svg class="w-6 h-6 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                    </svg>
                    <span class="ml-2">Lihat Gambar</span>
                </a>
            </div>
        </div>
        <img id="gambar-preview" src="#" alt="Lampiran Gambar" class="mt-2 w-full rounded-lg hidden">

        
        <div class="w-full flex justify-end mt-4">
            <button id="modal-close" class="cursor-pointer px-4 py-2 bg-blue text-primary rounded-lg">
                Kembali
            </button>
        </div>
    </div>
</div>
<?php /**PATH D:\0. joki\Refa\Revisi\pengarsipan_surat\resources\views\components\modal\detail_file.blade.php ENDPATH**/ ?>