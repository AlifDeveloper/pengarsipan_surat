<!-- Backdrop (overlay hitam) -->
<div id="backdrop"
    class="hidden fixed inset-0 w-screen z-50 h-screen bg-black/20 bg-opacity-30 backdrop-blur-md transition-opacity duration-300">
</div>

<!-- Modal Logout -->
<div id="add-data-modal" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="relative w-[400px] max-w-md bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header Modal -->
        <div class="bg-primary text-start py-4">
            <h3 class="text-md font-semibold ml-6"><span class="text-blue"></span> Tambah Klasifikasi Arsip</h3>
        </div>
        <hr class="h-px mt-1 bg-gray-200 border-0">

        <!-- Body Modal -->
        <form action="{{ route('klasifikasi-arsip.store') }}" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block mb-1 text-sm font-semibold text-slate-600">Kode Arsip</label>
                    <input type="text" name="kode_arsip" class="w-full  border border-slate-300 rounded-md px-3 py-2"
                        placeholder="Masukan kode arsip" required />
                </div>

                <div>
                    <label class="block mb-1 text-sm font-semibold text-slate-600">Nama Arsip</label>
                    <input type="text" name="nama_arsip" class="w-full border border-slate-300 rounded-md px-3 py-2"
                        placeholder="Masukan nama arsip" required />
                </div>
            </div>

            <!-- Footer Modal -->
            <div class="p-4 flex plt-0 justify-end">
                <button data-modal-hide="add-data-modal"
                    class="w-1/4 mr-6 text-red1 border border-red1 py-2 rounded-md cursor-pointer">Batal</button>
                <button type="submit" class="w-2/4 bg-blue text-white py-2 rounded-md cursor-pointer">Simpan</button>
            </div>
    </div>
    </form>
</div>
