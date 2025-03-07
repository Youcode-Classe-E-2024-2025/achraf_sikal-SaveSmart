@extends('layouts.app')

@section('title', 'Transaction')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4 py-8 max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Add Income / Expense</h1>

        <form action="{{ route('transactions.create') }}" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6" method="GET">
            @csrf
            <!-- Amount Field -->
            <div class="mb-4">
                <label for="amount" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Amount</label>
                <div class="relative">
                    <input type="number" id="amount" name="amount" required placeholder="200"
                           class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500">
                </div>
            </div>
            @error('amount')
                <div class="text-red-500"> {{ $message }} </div>
            @enderror

            <!-- Category Field -->
            <div class="mb-4">
                <label for="category" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Category</label>
                <select id="category" required name="category_id"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500">
                    <option value="" disabled selected>Select a category</option>
                    @foreach ($defCategory as $Category)
                        <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                    @endforeach
                    <option value="" disabled>Your Categories:</option>
                    @foreach ($customCategory as $Category)
                        <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category')
            <div class="text-red-500"> {{ $message }} </div>
            @enderror

            <!-- Date Field -->
            <div class="mb-4">
                <label for="date" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Date</label>
                <div class="relative">
                    <input type="date" id="date" name="date"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500">
                </div>
            </div>
            @error('date')
                <div class="text-red-500"> {{ $message }} </div>
            @enderror

            <!-- Notes Field -->
            <div class="mb-6">
                <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Description (Optional)</label>
                <textarea id="description" name="description" placeholder="Optional description" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500"></textarea>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-500 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out transform hover:scale-105 dark:bg-blue-700 dark:hover:bg-blue-600 dark:focus:ring-blue-400">
                    Save
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
