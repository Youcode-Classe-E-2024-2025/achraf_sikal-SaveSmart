@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Create your account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Or
                <a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Login in to your existing account
                </a>
            </p>
        </div>
        <form class="mt-8 space-y-6" action="/signup" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
            <div class="flex flex-col items-center space-y-4">
    <!-- Image Preview -->
    <label for="avatar" class="cursor-pointer w-32 h-32 border-2 border-gray-300 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
        <img id="avatarPreview" class="hidden w-full h-full object-cover" />
        <span id="avatarPlaceholder" class="text-gray-500">No Image</span>
    </label>

    <!-- File Input (Hidden) -->
    <input id="avatar" name="avatar" type="file" accept="image/*" class="hidden" onchange="previewAvatar(event)">
</div>

<script>
    function previewAvatar(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
                document.getElementById('avatarPreview').classList.remove('hidden');
                document.getElementById('avatarPlaceholder').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>

                <div>
                    <label for="name" class="sr-only">Full name</label>
                    <input id="name" name="name" type="text" autocomplete="name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Full name">
                </div>
                <div>
                    <label for="email-address" class="sr-only">Email address</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                </div>
                <div>
                    <label for="password_confirmation" class="sr-only">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Confirm password">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="agree-terms" name="agree-terms" type="checkbox" required class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="agree-terms" class="ml-2 block text-sm text-gray-900">
                        I agree to the <a href="#" class="text-indigo-600 hover:text-indigo-500">Terms and Conditions</a>
                    </label>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Sign up
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add client-side validation
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        // Perform client-side validation
        const name = document.getElementById('name').value;
        const email = document.getElementById('email-address').value;
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        const agreeTerms = document.getElementById('agree-terms').checked;

        let isValid = true;
        let errorMessage = '';

        if (name.trim() === '') {
            isValid = false;
            errorMessage += 'Name is required.\n';
        }

        if (email.trim() === '' || !email.includes('@')) {
            isValid = false;
            errorMessage += 'Valid email is required.\n';
        }

        if (password.length < 8) {
            isValid = false;
            errorMessage += 'Password must be at least 8 characters long.\n';
        }

        if (password !== passwordConfirmation) {
            isValid = false;
            errorMessage += 'Passwords do not match.\n';
        }

        if (!agreeTerms) {
            isValid = false;
            errorMessage += 'You must agree to the Terms and Conditions.\n';
        }

        if (isValid) {
            form.submit();
        } else {
            alert(errorMessage);
        }
    });
</script>
@endpush
