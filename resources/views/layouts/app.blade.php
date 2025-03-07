<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Elegant SaveSmart')</title>
    <link rel="icon" type="image/x-icon" href="favicon.webp">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        @keyframes pulse-scale {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
        }
        .animate-pulse-scale {
        animation: pulse-scale 2s infinite;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-black min-h-screen flex flex-col">
    <!-- Navigation -->
    <x-nav-bar />
    
    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} SaveSmart. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
