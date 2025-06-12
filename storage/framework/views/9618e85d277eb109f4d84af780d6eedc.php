<?php echo $__env->make('components.modal.modal-delete', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('components.modal.detail_file', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-transparent rounded-lg mb-4">
        <h2 class="text-[26px] text-gray-800 font-bold">Surat Masuk</h2>
        <p class="text-gray-500 text-sm"><span class='text-blue'>Berada</span> / <span class='text-blue'>Pengarsipan</span> / Surat Masuk</p>
    </div>

    <!-- Search Section -->
    <form action="<?php echo e(auth()->user()->level_user == 'kades' ? route('pengarsipan-surat-masuk.index') : route('surat-masuk.index')); ?>" method="GET">
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
                    <label class="block mb-1 text-sm  mt-4 font-medium">
                        Cari Bulan
                    </label>
                    <select name="bulan" class="w-full text-sm bg-transparent border text-gray1 border-slate-200 rounded-md px-3 py-2">
                        <option value="">-- Pilih Bulan --</option>
                        <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($month); ?>" <?php echo e(request('bulan') == $month ? 'selected' : ''); ?>>
                                <?php echo e(date('F', mktime(0, 0, 0, $month, 1))); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="w-full md:w-4/12 mr-4">
                    <label class="block mb-1 text-sm  mt-4 font-medium">
                        Cari Tahun
                    </label>
                    <select name="tahun" class="w-full text-sm bg-transparent border text-gray1 border-slate-200 rounded-md px-3 py-2">
                        <option value="">-- Pilih Tahun --</option>
                        <?php for($year = date('Y'); $year >= date('Y') - 5; $year--): ?>
                            <option value="<?php echo e($year); ?>" <?php echo e(request('tahun') == $year ? 'selected' : ''); ?>>
                                <?php echo e($year); ?>

                            </option>
                        <?php endfor; ?>
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
                    <h3 class="text-md font-bold text-gray-800">Data arsip surat masuk</h3>
                    <p class="text-slate-500 text-sm">Berikut adalah data surat masuk yang tersedia.</p>
                </div>
            </div>
            <div class="ml-3 <?php echo e(auth()->user()->level_user == 'kades' ? 'hidden' : ''); ?>">
                <div class="relative">
                    <a href="<?php echo e(route('surat-masuk.create')); ?>"
                        class="bg-blue-500 text-white px-3 cursor-pointer py-2 rounded-md text-sm">
                        Tambah Surat Masuk
                    </a>
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
                                <p class="flex items-center gap-2  font-medium leading-none">
                                    No
                                </p>
                            </th>

                            <th
                                class="p-2 w-40 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none ">
                                    Kode arsip
                                </p>
                            </th>
                            <th
                                class="p-2 w-30 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none ">
                                    Tanggal Masuk
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
                                <p class="flex items-center justify-between gap-2  font-medium leading-none ">
                                    Perihal Surat
                                </p>
                            </th>
                            <th
                                class="p-2 w-40 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none ">
                                    Asal Surat
                                </p>
                            </th>
                            <th
                                class="p-2 w-40 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none ">
                                    Penanggung Jawab
                                </p>
                            </th>
                            <th
                                class="p-2 w-30 text-center transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none ">
                                    Lampiran
                                </p>
                            </th>
                            <th
                                class="p-2 w-14 text-center justify-center transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100 <?php echo e(auth()->user()->level_user == 'kades' ? 'hidden' : ''); ?>">
                                <p class="flex items-center justify-between gap-2  font-medium leading-none ">
                                    Aksi
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $surat_masuk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-slate-50">
                                <td class="p-2 border border-slate-200 text-center">
                                    <p class="block  text-slate-800">
                                        <?php echo e(($surat_masuk->currentPage() - 1) * $surat_masuk->perPage() + $loop->iteration); ?>

                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        <?php echo e($item->kode_arsip); ?> [<?php echo e($item->klasifikasi_arsip->nama_arsip); ?>]
                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        <?php echo e($item->tgl_surat); ?>

                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        <?php echo e($item->no_suratmasuk); ?>

                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        <?php echo e($item->perihal); ?>

                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        <?php echo e($item->asal_surat); ?>

                                    </p>
                                </td>
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        <?php echo e($item->petugas->jabatan); ?>

                                    </p>
                                </td>

                                
                                <td class="p-2 border border-slate-200">
                                    <p class="block  text-slate-800">
                                        
                                        <a data-modal-toggle = "modal-detail"
                                            data-file-pdf = <?php echo e(asset('storage/' . $item->lampiran_pdf)); ?>

                                            data-file-gambar = <?php echo e(asset('storage/' . $item->lampiran_gambar)); ?>

                                            class=" flex bg-blue-500 text-white px-1 py-1 rounded-lg cursor-pointer rounded-md text-xs">
                                            <svg class="w-4 h-4 text-primary" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                            </svg>
                                            <span class="ml-2">Lihat File</span>
                                        </a>
                                    </p>
                                </td>

                                
                                <td class="p-2 border flex border-slate-200 <?php echo e(auth()->user()->level_user == 'kades' ? 'hidden' : ''); ?>">
                                    <p class="block  text-red1">
                                        <a data-modal-toggle = "delete-modal"
                                            data-id = "<?php echo e($item->no_suratmasuk); ?>"
                                            data-url = "<?php echo e(route('suratmasuk.delete', $item->no_suratmasuk)); ?>"
                                            class=" flex bg-transparent text-white px-1 py-1 rounded-lg cursor-pointer  text-xs">
                                            <svg class="w-6 h-6 text-red1" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                        </a>
                                    </p>
                                    <p class="block  text-red1">
                                        <a href="<?php echo e(route('surat-masuk.edit', $item->no_suratmasuk)); ?>"
                                            class=" flex bg-transparent text-white px-1 py-1 rounded-lg cursor-pointer  text-xs">
                                            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                              </svg>

                                        </a>
                                    </p>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="p-4 border border-slate-200 text-center text-gray-500">Data
                                    tidak tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-between items-center mt-4 text-blue">
            <a href="<?php echo e($surat_masuk->previousPageUrl()); ?>"
                class="flex items-center justify-center rounded-md border border-blue py-2 px-3 text-center text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue hover:border-blue <?php echo e($surat_masuk->onFirstPage() ? 'opacity-50 cursor-not-allowed' : ''); ?>">
                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="ml-2">Prev</span>
            </a>
            <div class="flex space-x-2">
                <div class="flex space-x-2">
                    <?php for($i = 1; $i <= $surat_masuk->lastPage(); $i++): ?>
                        <a href="<?php echo e($surat_masuk->url($i)); ?>"
                            class="min-w-9 rounded-md py-2 px-3 text-center text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue
                        <?php echo e($surat_masuk->currentPage() == $i ? 'bg-blue text-white' : 'border border-slate-300'); ?>">
                            <?php echo e($i); ?>

                        </a>
                    <?php endfor; ?>
                </div>
            </div>
            <a href="<?php echo e($surat_masuk->nextPageUrl()); ?>"
                class="flex items-center justify-center rounded-md border border-blue py-2 px-3 text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue hover:border-blue
                <?php echo e($surat_masuk->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed'); ?>">
                <span class="mr-2">Next</span>
                <svg class="w-2.5 h-2.5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="node_modules/@material-tailwind/html@latest/scripts/dialog.js"></script>
    <script>
        function toggleDropdown() {
            document.getElementById("dropdown").classList.toggle("hidden");
        }
    </script>

    <?php if(session('success')): ?>
    <script>
        Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?php echo e(session('success')); ?>',
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
    <?php endif; ?>

    <script>
        function resetForm() {
            // Reset form dan redirect ke halaman tanpa parameter
            window.location.href = '<?php echo e(auth()->user()->level_user == 'kades' ? route('pengarsipan-surat-masuk.index') : route('surat-masuk.index')); ?>';
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('components.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\0. joki\Refa\Revisi\pengarsipan_surat\resources\views\content\pengarsipan\suratMasuk\index.blade.php ENDPATH**/ ?>