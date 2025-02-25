@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
<div class="bg-white shadow-md rounded-lg max-w-4xl mx-auto my-8">
    <div class="p-6">
        <div class="flex items-center space-x-6 mb-6">
            <img class="h-24 w-24 rounded-full object-cover" src="{{ "/storage/".$user->avatar ?? 'https://placeholder.com/150x150' }}" alt="{{ $user->name }}'s avatar">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                <p class="text-gray-600">Member since {{ $user->created_at->format('F Y') }}</p>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-6">
            <h2 class="text-2xl font-semibold mb-4">User Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Email</p>
                    <p class="font-medium">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Library Card Number</p>
                    <p class="font-medium">{{ $user->library_card_number ?? 'Not assigned' }}</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-6 mt-6">
            <h2 class="text-2xl font-semibold mb-4">Reading Activity</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-4xl font-bold text-gray-800">{{ $user->books_read_count ?? 0 }}</p>
                    <p class="text-gray-600">Books Read</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-4xl font-bold text-gray-800">{{ $user->currently_borrowed_count ?? 0 }}</p>
                    <p class="text-gray-600">Currently Borrowed</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-4xl font-bold text-gray-800">{{ $user->reviews_count ?? 0 }}</p>
                    <p class="text-gray-600">Reviews Written</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-6 mt-6">
            <h2 class="text-2xl font-semibold mb-4">Recently Borrowed Books</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="recently-borrowed">
                <!-- Recently borrowed books will be dynamically added here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Sample recently borrowed books data
    const recentlyBorrowedBooks = [
        { title: "The Catcher in the Rye", author: "J.D. Salinger", cover: "https://placeholder.com/150x200", borrowDate: "2025-02-10" },
        { title: "Pride and Prejudice", author: "Jane Austen", cover: "https://placeholder.com/150x200", borrowDate: "2025-02-05" },
        { title: "The Hobbit", author: "J.R.R. Tolkien", cover: "https://placeholder.com/150x200", borrowDate: "2025-01-28" },
    ];

    // Function to create book cards
    function createBookCard(book) {
        return `
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 transform hover:scale-105">
                <img src="${book.cover}" alt="${book.title}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">${book.title}</h3>
                    <p class="text-gray-600 text-sm">${book.author}</p>
                    <p class="text-gray-500 text-xs mt-2">Borrowed on ${book.borrowDate}</p>
                </div>
            </div>
        `;
    }

    // Populate recently borrowed books
    const recentlyBorrowedContainer = document.getElementById('recently-borrowed');
    recentlyBorrowedBooks.forEach(book => {
        recentlyBorrowedContainer.innerHTML += createBookCard(book);
    });
</script>
@endpush
