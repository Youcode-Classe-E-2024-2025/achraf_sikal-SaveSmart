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
            </div>
        </div>

    </div>
</div>
@endsection
