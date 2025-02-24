<nav class="bg-gray-800 text-white p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="text-xl font-bold">
            <a href="/" class="hover:text-gray-300">Library Manager</a>
        </div>

        <div class="flex space-x-4">
            <!-- Navigation Links -->

            <!-- Authentication Links -->
            @auth
            <div x-data="{ open: false }" class="relative">
            <!-- Profile Picture Button -->
            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                <img src="{{ asset('/storage/' . auth()->user()->avatar) }}"
                    class="w-10 h-10 rounded-full border-2 border-gray-300 shadow-sm"
                    alt="User Avatar">
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200">
                <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg">
                    Profile
                </a>
                <a href="/books" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg">
                    My books
                </a>
                <a href="/borrowed" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg">
                    Borrowed books
                </a>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-b-lg">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Include Alpine.js (if not already included) -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

            @else
                <x-nav-link href="/login" label="Login"/>
                <x-nav-link href="/signup" label="Signup"/>
            @endauth
        </div>
    </div>
</nav>
