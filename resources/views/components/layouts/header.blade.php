<header class="bg-white shadow-md p-4 flex justify-end items-center sticky top-0 z-40">
    <div class="flex items-center space-x-4 relative">
        <div class="relative mr-6">
            <img
                alt="tania andrew"
                src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile.png') }}"
                class="relative inline-block h-10 w-10 cursor-pointer rounded-full object-cover object-center"
                id="profile-button"
                onclick="toggleDropdownProfile()"
            />
            <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-md border-gray-200 border-lg border shadow-lg py-1 hidden z-50">
                <a href="{{ auth()->user()->level_user == 'kades' ? route('profile-info.index') : route('profile.index') }}" 
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil Saya
                    </div>
                </a>
                <hr class="h-px bg-gray-200 border-0">
                <a data-modal-toggle='logout-modal' class="block cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </div>
                </a>
            </div>
        </div>
    </div>
</header>
