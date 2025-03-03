@extends('layouts.app')

@section('title', 'Transaction')

@section('content')
<div class="bg-gray-50 min-h-screen">
<div class="container mx-auto px-4 py-8 max-w-md">
<h1 class="text-2xl font-bold text-gray-800 mb-6">Add Income / Expense</h1>

<form class="bg-white shadow-md rounded-lg p-6">

    <div class="mb-4">
        <label for="type" class="block text-gray-700 text-sm font-medium mb-2">type</label>
        <select id="type" name="type" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="" disabled selected>Select a type</option>
            <option value="food">expense</option>
            <option value="rent">Income</option>
        </select>
    </div>

    <!-- Amount Field -->
    <div class="mb-4">
    <label for="amount" class="block text-gray-700 text-sm font-medium mb-2">Amount</label>
    <div class="relative">
        <input type="number" id="amount" name="amount" placeholder="200" class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>
    </div>

    <!-- Category Field -->
    <div class="mb-4">
    <label for="category" class="block text-gray-700 text-sm font-medium mb-2">Category</label>
    <select id="category" name="category"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <option value="" disabled selected>Select a category</option>
        <option value="food">Food</option>
        <option value="rent">Rent</option>
        <option value="utilities">Utilities</option>
        <option value="transportation">Transportation</option>
        <option value="entertainment">Entertainment</option>
        <option value="healthcare">Healthcare</option>
        <option value="education">Education</option>
    </select>
    </div>

    <!-- Date Field -->
    <div class="mb-4">
    <label for="date" class="block text-gray-700 text-sm font-medium mb-2">Date</label>
    <div class="relative">
        <input type="date" id="date" name="date"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>
    </div>

    <!-- Notes Field -->
    <div class="mb-6">
    <label for="notes" class="block text-gray-700 text-sm font-medium mb-2">Notes (Optional)</label>
    <textarea id="notes" name="notes" placeholder="Optional description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
    </div>

    <!-- Save Button -->
    <div class="flex justify-end">
    <button type="submit" class="px-4 py-2 bg-black text-white font-medium rounded-md hover:bg-white hover:text-black hover:outline-2 outline-black focus:ring-2 focus:ring-black focus:ring-offset-2 transition-colors">
        Save
    </button>
    </div>
</form>
</div>
</div>


@endsection
