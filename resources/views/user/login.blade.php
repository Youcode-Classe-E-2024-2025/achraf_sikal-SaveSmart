@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="bg-stone-100 dark:bg-stone-900 text-black dark:text-white flex items-center justify-center min-h-screen">
<div class="w-full max-w-md">
        <div class="bg-white dark:bg-stone-800 bg-opacity-90 dark:bg-opacity-90 shadow-lg rounded-2xl p-8 backdrop-blur-md">
            <h2 class="text-center text-3xl font-extrabold text-black dark:text-white">
                Sign in to your account
            </h2>
            <p class="mt-2 text-center text-sm text-stone-600 dark:text-stone-400">
                Or
                <a href="/signup" class="font-medium text-primary hover:text-secondary">
                    create a new account
                </a>
            </p>

            <form class="mt-8 space-y-6" action="" method="POST">
            @csrf
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="appearance-none relative block w-full px-3 py-3 border border-stone-300 dark:border-stone-700 placeholder-stone-500 text-black dark:text-white rounded-lg bg-stone-50 dark:bg-stone-700 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="Email address">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none relative block w-full px-3 py-3 border border-stone-300 dark:border-stone-700 placeholder-stone-500 text-black dark:text-white rounded-lg bg-stone-50 dark:bg-stone-700 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="Password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-primary focus:ring-primary border-stone-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-black dark:text-stone-300">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="" class="font-medium text-primary hover:text-secondary">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="bg-black group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition transform hover:scale-105">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        </span>
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        form.submit();
    });
</script>
@endpush
