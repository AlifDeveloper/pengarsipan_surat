<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | Pengarsipan Surat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-blue-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('components.modal.modal_logout')
        @include('components.layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            @include('components.layouts.header')

            <!-- Content -->
            <main class="p-6 flex-1 overflow-auto font-poppins">
                @yield('content')
            </main>
        </div>
    </div>
</body>
@yield('scripts')
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
