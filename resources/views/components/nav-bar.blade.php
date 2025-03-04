<nav class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="/" class="text-xl font-bold text-gray-900 dark:text-white hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                    SaveSmart
                </a>
            </div>
            <div class="flex gap-4 p-4 justify-between">
        <!-- Back Button -->
        <button
        class="flex items-center justify-center gap-2 px-6 py-3 font-bold text-white bg-gradient-to-r from-purple-600 to-blue-500 rounded-lg
        hover:from-purple-700 hover:to-blue-600
        focus:outline-none focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-800
        transition-all duration-300 transform hover:-translate-x-1 hover:shadow-lg hover:shadow-purple-500/50
        dark:shadow-blue-800/80"
        onclick="history.back()">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-pulse-scale">
            <path d="m12 19-7-7 7-7"></path>
            <path d="M19 12H5"></path>
        </svg>
        <span>Go Back</span>
        </button>

        <!-- Forward Button -->
        <button
        class="flex items-center justify-center gap-2 px-6 py-3 font-bold text-white bg-gradient-to-r from-pink-500 to-orange-500 rounded-lg
        hover:from-pink-600 hover:to-orange-600
        focus:outline-none focus:ring-4 focus:ring-pink-300 dark:focus:ring-pink-800
        transition-all duration-300 transform hover:translate-x-1 hover:shadow-lg hover:shadow-pink-500/50
        dark:shadow-orange-800/80"
        onclick="history.forward()">
        <span>Go Forward</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-pulse-scale">
            <path d="M5 12h14"></path>
            <path d="m12 5 7 7-7 7"></path>
        </svg>
        </button>
    </div>

            <div class="flex items-center gap-4">
                <!-- Dark Mode Toggle -->
                <div class="relative p-4">
                    <button id="theme-toggle" type="button"
                        class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg">
                        <svg id="sun-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg id="moon-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <!-- Theme Selector Dropdown -->
                    <div id="theme-dropdown"
                        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 hidden">
                        <button onclick="setTheme('light')"
                            class="w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Light
                        </button>
                        <button onclick="setTheme('dark')"
                            class="w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Dark
                        </button>
                        <button onclick="setTheme('system')"
                            class="w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            System
                        </button>
                    </div>
                </div>

                @auth
                    <div x-data="{ open: false }" class="relative">
                        <!-- Profile Button -->
                        <button
                            @click="open = !open"
                            type="button"
                            class="flex items-center transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-gray-700 rounded-full"
                            :aria-expanded="open"
                            aria-haspopup="true"
                        >
                            <span class="sr-only">Open user menu</span>
                            <img
                                src="{{ asset('/storage/' . auth()->user()->avatar) }}"
                                alt="{{ auth()->user()->name }}"
                                class="h-9 w-9 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700 shadow-sm"
                            >
                        </button>
                        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
                        <!-- Dropdown -->
                        <div
                            x-show="open"
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 rounded-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 shadow-lg divide-y divide-gray-100 dark:divide-gray-700"
                            style="display: none;"
                            class="z-50"
                        >
                            <div class="px-4 py-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>

                            <div class="py-1">
                                <a href="/profile" class="group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Profile
                                </a>

                            </div>

                            <div class="py-1">
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="group flex w-full items-center px-4 py-2 text-sm text-red-600 dark:text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <svg class="mr-3 h-5 w-5 text-red-500 dark:text-red-400 group-hover:text-red-600 dark:group-hover:text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="/login" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                        Login
                    </a>
                    <a href="/signup" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-900 dark:bg-gray-700 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-600 transition-colors">
                        Sign up
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
<script>
const themeToggle = document.getElementById('theme-toggle');
const themeDropdown = document.getElementById('theme-dropdown');
const sunIcon = document.getElementById('sun-icon');
const moonIcon = document.getElementById('moon-icon');

function updateIcons() {
    const isDark = document.documentElement.classList.contains('dark');
    sunIcon.classList.toggle('hidden', !isDark);
    moonIcon.classList.toggle('hidden', isDark);
}

function setTheme(theme) {
    if (theme === 'dark') {
        localStorage.setItem('theme', 'dark');
        document.documentElement.classList.add('dark');
    } else if (theme === 'light') {
        localStorage.setItem('theme', 'light');
        document.documentElement.classList.remove('dark');
    } else {
        localStorage.removeItem('theme');
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
    updateIcons();
    themeDropdown.classList.add('hidden');
}

themeToggle.addEventListener('click', () => {
    themeDropdown.classList.toggle('hidden');
});

document.addEventListener('click', (e) => {
    if (!themeToggle.contains(e.target) && !themeDropdown.contains(e.target)) {
        themeDropdown.classList.add('hidden');
    }
});
document.addEventListener('keydown', (e) => {
    if (e.key === 'D' && e.shiftKey) {
        document.documentElement.classList.toggle('dark');
    }
});
if (localStorage.getItem('theme') === 'dark' ||
    (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}
updateIcons();
</script>
