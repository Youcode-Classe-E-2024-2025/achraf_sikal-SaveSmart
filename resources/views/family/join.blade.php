@extends('layouts.app')

@section('content')

@vite('resources/css/style.css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div class="container">
        <div class="card">
            <div class="toggle-container">
                <button class="toggle-btn active" data-target="join">Join Family</button>
                <button class="toggle-btn" data-target="create">Create Family</button>
                <div class="slider"></div>
            </div>

            <div class="forms-container">
                <div class="form-wrapper join-form active">
                    <h2><i class="fas fa-users"></i> Join a Family</h2>
                    <p class="subtitle">Connect with your loved ones by entering your family ID</p>

                    <form action="{{ route('family.join') }}" method="POST">
                        <div class="input-group">
                            <label for="family_id">Family ID</label>
                            <div class="input-wrapper">
                                <i class="fas fa-hashtag icon"></i>
                                <input type="text" id="family_id" name="family_id" required>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn join-btn">
                            <span class="btn-text">Join Family</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>

                    <div class="decoration">
                        <div class="circle circle-1"></div>
                        <div class="circle circle-2"></div>
                        <div class="circle circle-3"></div>
                    </div>
                </div>

                <div class="form-wrapper create-form">
                    <h2><i class="fas fa-home"></i> Create a Family</h2>
                    <p class="subtitle">Start your own family group and invite others to join</p>

                    <form action="{{ route('family.create') }}" method="POST">
                        <div class="input-group">
                            <label for="family_name">Family Name</label>
                            <div class="input-wrapper">
                                <i class="fas fa-signature icon"></i>
                                <input type="text" id="family_name" name="family_name" required>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn create-btn">
                            <span class="btn-text">Create Family</span>
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>

                    <div class="decoration">
                        <div class="square square-1"></div>
                        <div class="square square-2"></div>
                        <div class="square square-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/script.js')

@endsection
