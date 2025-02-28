@extends('layouts.app')

@section('title', 'Profile Dashboard')

@section('content')
<div class="bg-white shadow-md rounded-lg max-w-4xl mx-auto my-8">
    <div class="p-6">
        <!-- Profile Header -->
        <div class="flex flex-col md:flex-row md:items-center gap-6 mb-6">
            <img class="h-24 w-24 rounded-full object-cover mx-auto md:mx-0"
                 src="{{ "/storage/".$user->avatar ?? 'https://placeholder.com/150x150' }}"
                 alt="{{ $user->name }}'s avatar">
            <div class="text-center md:text-left">
                <h1 class="text-3xl font-bold text-gray-900">{{ $profile->name }}</h1>
                <p class="text-gray-600">Member since {{ $profile->created_at->format('j F Y') }}</p>
            </div>
        </div>

        <!-- User Information -->
        <div class="border-t border-gray-200 pt-6">
            <h2 class="text-2xl font-semibold mb-4">User Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-600 text-sm">Email</p>
                    <p class="font-medium">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="mt-8 border-t border-gray-200 pt-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold">Categories</h2>
                <button id="addCategoryBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                    + Add Category
                </button>
            </div>



            <!-- Category Modal -->
            <div id="categoryModal" class="inset-0 flex items-center justify-center hidden z-50">
                <div class="absolute inset-0 bg-black bg-opacity-50" id="modalOverlay"></div>
                <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative z-10">
                    <h2 class="text-xl font-semibold mb-4">Add New Category</h2>
                    <form action="{{ route('categories.create') }}" method="GET">
                        @csrf
                        <div class="mb-4">
                            <label for="category_name" class="block text-gray-700 mb-2">Category Name</label>
                            <input type="text" id="category_name" name="name" required class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="category_type" class="block text-gray-700 mb-2">Category type</label>
                            <select name="type" id="" required class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="{{ $profile->id }}">
                        <div class="flex justify-end">
                            <button type="button" id="closeModal" class="text-gray-600 mr-4 hover:text-gray-800">Cancel</button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Category List would go here -->
        <div class="bg-gray-50 p-4 rounded-lg">
                <!-- Categories would be listed here -->
                @forelse($categories as $category)
                    <div class="border-b border-gray-200 p-4 hover:bg-gray-100 transition-colors">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium">{{ $category->name }}</p>
                                <p class="text-gray-600 text-sm">{{ $category->created_at->format('j M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4">
                        <p class="text-gray-600">No categories found.</p>
                    </div>
                @endforelse
            </div>
        <!-- Transactions Section -->
        <div class="mt-8 border-t border-gray-200 pt-6">
            <h2 class="text-2xl font-semibold mb-4">Recent Transactions</h2>
            <div class="bg-gray-50 rounded-lg overflow-hidden">
                @forelse($transactions as $transaction)
                    <div class="border-b border-gray-200 p-4 hover:bg-gray-100 transition-colors">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium">{{ $transaction->description }}</p>
                                <p class="text-gray-600 text-sm">{{ $transaction->created_at->format('j M Y, H:i') }}</p>
                            </div>
                            <p class="font-bold {{ $transaction->amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->amount }} USD
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="p-4">
                        <p class="text-gray-600">No transactions found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Modal -->
<script>
    // Get DOM elements
    const addCategoryBtn = document.getElementById("addCategoryBtn");
    const categoryModal = document.getElementById("categoryModal");
    const closeModal = document.getElementById("closeModal");
    const modalOverlay = document.getElementById("modalOverlay");

    // Open modal
    addCategoryBtn.addEventListener("click", function() {
        categoryModal.classList.remove("hidden");
        document.body.classList.add("overflow-hidden"); // Prevent scrolling when modal is open
    });

    // Close modal functions
    function closeModalFunction() {
        categoryModal.classList.add("hidden");
        document.body.classList.remove("overflow-hidden");
    }

    closeModal.addEventListener("click", closeModalFunction);
    modalOverlay.addEventListener("click", closeModalFunction);

    // Close modal when pressing Escape key
    document.addEventListener("keydown", function(event) {
        if (event.key === "Escape" && !categoryModal.classList.contains("hidden")) {
            closeModalFunction();
        }
    });
</script>
@endsection
