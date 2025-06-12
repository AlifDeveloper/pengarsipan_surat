<?php echo $__env->make('components.modal.detail_file', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-transparent rounded-lg mb-4">
    <h2 class="text-[26px] font-bold">Laporan Surat</h2>
    <p class="text-gray-500 text-sm"><span class='text-blue'>Berada</span> / Laporan Surat</p>
</div>

<div class="flex items-center gap-6 mb-4">
    <div class="bg-white rounded-lg font-bold shadow-md mt-4 p-4 items-center justify-center text-center">
        <h1><?php echo e($totalSuratMasuk); ?></h1>
        <h1>Surat Masuk  </h1>
    </div>
    <div class="bg-white rounded-lg font-bold shadow-md mt-4 p-4 items-center justify-center text-center">
        <h1><?php echo e($totalSuratKeluar); ?></h1>
        <h1>Surat Keluar  </h1>
    </div>
</div>

<!-- Search Section -->
<form action="<?php echo e(auth()->user()->level_user == 'kades' ? route('laporan-surat.index') : route('laporan.index')); ?>" method="GET">
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
            <div class="w-full md:w-2/12 mr-4">
                <label class="block mb-1 text-sm mt-4 font-medium">
                    Cari Bulan
                </label>
                <select id="bulan" name="bulan" class="w-full text-sm bg-transparent border text-gray1 border-slate-200 rounded-md px-3 py-2">
                    <option value="">-- Pilih Bulan --</option>
                    <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($month); ?>" <?php echo e(request('bulan') == $month ? 'selected' : ''); ?>>
                            <?php echo e(date('F', mktime(0, 0, 0, $month, 1))); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="w-full md:w-2/12 mr-4">
                <label class="block mb-1 text-sm mt-4 font-medium">
                    Cari Tahun
                </label>
                <select id="tahun" name="tahun" class="w-full text-sm bg-transparent border text-gray1 border-slate-200 rounded-md px-3 py-2">
                    <option value="">-- Pilih Tahun --</option>
                    <?php for($year = date('Y'); $year >= date('Y') - 5; $year--): ?>
                        <option value="<?php echo e($year); ?>" <?php echo e(request('tahun') == $year ? 'selected' : ''); ?>>
                            <?php echo e($year); ?>

                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="w-full md:w-4/12 mr-4">
                <label class="block mb-1 text-sm mt-4 font-medium">
                    Filter Arsip
                </label>
                <select id="arsip" name="arsip" class="w-full text-sm bg-transparent border text-gray1 border-slate-200 rounded-md px-3 py-2">
                    <option value="">-- Pilih Arsip --</option>
                    <?php $__currentLoopData = $klasifikasi_arsip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arsip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($arsip->kode_arsip); ?>" <?php echo e(request('arsip') == $arsip->kode_arsip ? 'selected' : ''); ?>><?php echo e($arsip->kode_arsip); ?> [<?php echo e($arsip->nama_arsip); ?>]</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <h3 class="text-md font-bold text-slate-800">Data arsip surat masuk & surat keluar</h3>
                <p class="text-slate-500 text-sm">Berikut adalah data surat masuk dan surat keluar periode <?php echo e($namaBulanIndonesia); ?> <?php echo e($tahun); ?>.</p>
            </div>
        </div>
        <div class="ml-3">
            <div class="relative">
                <button type="button" onclick="cetakPDF()" class="bg-blue-500 flex text-white px-3 cursor-pointer py-2 rounded-md text-sm">
                    <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z"/>
                    </svg>
                    <span>Cetak Arsip</span>
                </button>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <div class="border rounded-lg border-slate-50 overflow-hidden">
            <table class="min-w-full table-auto  text-xs ">
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
                                Tanggal Surat
                            </p>
                        </th>
                        <th
                            class="p-2 w-30 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                            <p class="flex items-center justify-between gap-2  font-medium leading-none">
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
                            class="p-2 w-25 items-center text-center transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                            <p class="flex items-center justify-between gap-2  font-medium leading-none ">
                                Jenis Surat
                            </p>
                        </th>
                        <th
                            class="p-2 w-40 transition-colors cursor-pointer border border-slate-300 bg-blue-50 hover:bg-slate-100">
                            <p class="flex items-center justify-between gap-2  font-medium leading-none">
                                Penanggung Jawab
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
                    <?php $__empty_1 = true; $__currentLoopData = $dataSurat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50">
                            <td class="p-2 border border-slate-200 text-center">
                                <p class="block  text-slate-800">
                                    <?php echo e(($dataSurat->currentPage() - 1) * $dataSurat->perPage() + $loop->iteration); ?>

                                </p>
                            </td>
                            <td class="p-2 border border-slate-200">
                                <p class="block  text-slate-800">
                                    <?php echo e($item->kode_arsip ? $item->kode_arsip . ' [' . optional($item->klasifikasi_arsip)->nama_arsip . ']' : '-'); ?>

                                </p>
                            </td>
                            <td class="p-2 border border-slate-200">
                                <p class="block  text-slate-800">
                                    <?php echo e($item->tgl_surat); ?>

                                </p>
                            </td>
                            <td class="p-2 border border-slate-200">
                                <p class="block  text-slate-800">
                                    <?php echo e($item->no_surat); ?>

                                </p>
                            </td>
                            <td class="p-2 border border-slate-200">
                                <p class="block  text-slate-800">
                                    <?php echo e($item->perihal); ?>

                                </p>
                            </td>
                            <td class="p-2 text-center border border-slate-200">
                                <p class="block  text-slate-800">
                                    <?php echo e($item->jenis); ?>

                                </p>
                            </td>
                            <td class="p-2 border border-slate-200">
                                <p class="block  text-slate-800">
                                    <?php echo e($item->petugas->jabatan ?? '-'); ?>

                                </p>
                            </td>

                            
                            <td class="p-2 border text-center border-slate-200">
                                <p class="block text-center text-slate-800">
                                    <a href="javascript:void(0);" onclick="printImage('<?php echo e(asset('storage/' . $item->lampiran_gambar)); ?>')"
                                        class="flex text-center bg-green-500 text-white px-1 py-1 rounded-lg cursor-pointer rounded-md text-xs">
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
        <a href="<?php echo e($dataSurat->previousPageUrl()); ?>"
            class="flex items-center justify-center rounded-md border border-blue py-2 px-3 text-center text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue hover:border-blue <?php echo e($dataSurat->onFirstPage() ? 'opacity-50 cursor-not-allowed' : ''); ?>">
            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 1 1 5l4 4" />
            </svg>
            <span class="ml-2">Prev</span>
        </a>
        <div class="flex space-x-2">
            <div class="flex space-x-2">
                <?php for($i = 1; $i <= $dataSurat->lastPage(); $i++): ?>
                    <a href="<?php echo e($dataSurat->url($i)); ?>"
                        class="min-w-9 rounded-md py-2 px-3 text-center text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue
                    <?php echo e($dataSurat->currentPage() == $i ? 'bg-blue text-white' : 'border border-slate-300'); ?>">
                        <?php echo e($i); ?>

                    </a>
                <?php endfor; ?>
            </div>
        </div>
        <a href="<?php echo e($dataSurat->nextPageUrl()); ?>"
            class="flex items-center justify-center rounded-md border border-blue py-2 px-3 text-xs transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-blue hover:border-blue
            <?php echo e($dataSurat->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed'); ?>">
            <span class="mr-2">Next</span>
            <svg class="w-2.5 h-2.5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>
        </a>
    </div>
</div>

<form id="cetakForm" method="GET" class="hidden">
    <input type="hidden" name="bulan" value="<?php echo e(request('bulan')); ?>">
    <input type="hidden" name="tahun" value="<?php echo e(request('tahun')); ?>">
    <input type="hidden" name="arsip" value="<?php echo e(request('arsip')); ?>">
    <input type="hidden" name="cetak_pdf" value="1">
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="node_modules/@material-tailwind/html@latest/scripts/dialog.js"></script>
    <script>
        function toggleDropdown() {
            document.getElementById("dropdown").classList.toggle("hidden");
        }
    </script>

    <script>
        function resetForm() {
            // Reset form dan redirect ke halaman tanpa parameter
            window.location.href = '<?php echo e(auth()->user()->level_user == 'kades' ? route('laporan-surat.index') : route('laporan.index')); ?>';
        }
    </script>

    <script>
        function cetakPDF() {
            const bulan = document.getElementById('bulan').value;
            const tahun = document.getElementById('tahun').value;
            const arsip = document.getElementById('arsip').value;

            document.querySelector('#cetakForm input[name="bulan"]').value = bulan;
            document.querySelector('#cetakForm input[name="tahun"]').value = tahun;
            document.querySelector('#cetakForm input[name="arsip"]').value = arsip;

            document.getElementById('cetakForm').submit();

        }

        function printImage(imageUrl) {
            var newWindow = window.open("", "_blank");
            newWindow.document.write(`
                <html>
                <head>
                    <title>Print Image</title>
                    <style>
                        body { margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
                        img { width: 100%; height: auto; display: block; margin: auto; }
                    </style>
                </head>
                <body>
                    <img src="${imageUrl}" onload="window.print(); window.close();">
                </body>
                </html>
            `);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('components.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\0. joki\Refa\Revisi\pengarsipan_surat\resources\views\content\laporan\index.blade.php ENDPATH**/ ?>