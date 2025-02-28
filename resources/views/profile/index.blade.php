@extends('layouts.app')

@section('title', 'Home')

@section('content')
@vite('resources/css/style.css')
<div class="container">
<div class="grid grid-cols-3 gap-4">
    @foreach ($profiles as $profile)
        <a href="{{ route('profile.show',$profile['id']) }}" class="flex items-center space-x-4 bg-gray-100 p-3 rounded-lg shadow-md">
            <div>
                <div class="w-12 h-12 bg-blue-500 text-white flex items-center justify-center rounded-full text-lg font-bold">
                    {{ strtoupper(substr($profile["name"], 0, 1)) }}
                </div>
                <div class="text-gray-800 font-semibold">
                    {{ $profile["name"] }}
                </div>
            </div>
        </a>
    @endforeach
</div>
    <div class="card">
        <div class="forms-container">
            <div class="form-wrapper join-form active">
                <form action="{{ route('profile.create') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <label for="profile_name">profile Name</label>
                        <div class="input-wrapper">
                            <i class="fas fa-signature icon"></i>
                            <input type="text" @error('profile_name') class="border-red-500" @enderror id="profile_name" name="profile_name" required>
                            @error('profile_name')
                                <div class="text-red-500"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="submit-btn create-btn">
                        <span class="btn-text">Create profile</span>
                        <i class="fas fa-plus"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
