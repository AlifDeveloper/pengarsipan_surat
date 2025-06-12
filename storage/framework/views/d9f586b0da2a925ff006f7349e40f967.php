<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($title); ?> | Pengarsipan Surat</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-blue-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php echo $__env->make('components.modal.modal_logout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('components.layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <?php echo $__env->make('components.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Content -->
            <main class="p-6 flex-1 overflow-auto font-poppins">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
</body>
<?php echo $__env->yieldContent('scripts'); ?>
</html>
<script>
    function toggleDropdownProfile() {
    const dropdown = document.getElementById('dropdown-menu');
    dropdown.classList.toggle('hidden');
}

// Menutup dropdown ketika user mengklik di luar dropdown
window.addEventListener('click', function(event) {
    const dropdown = document.getElementById('dropdown-menu');
    const profileButton = document.getElementById('profile-button');

    if (!profileButton.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});

</script>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<?php /**PATH D:\0. joki\Refa\Revisi\pengarsipan_surat\resources\views\components\layouts\main.blade.php ENDPATH**/ ?>