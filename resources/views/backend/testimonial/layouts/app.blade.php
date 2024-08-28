<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include FontAwesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/image-picker/0.3.1/image-picker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/image-picker/0.3.1/image-picker.min.js"></script>


    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        /* Navigation bar fixed at the top */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
        }

        /* Content area scrollable */
        main {
            overflow-y: auto;
            padding: 1rem;
        }

        .select-with-icons {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            appearance: none; /* Remove default arrow */
            background: white;
            position: relative;
            font-family: 'Figtree', sans-serif;
        }

        .select-with-icons option {
            padding-left: 30px;
            font-size: 16px;
        }

        .select-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            font-size: 20px;
        }


    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<!-- Header with Navigation -->
<header class="fixed top-0 left-0 w-full z-10">
    @include('layouts.navigation')
</header>

<!-- Main Wrapper -->
<div class="flex h-screen pt-16">
    <!-- Sidebar -->
    <aside class="w-64 bg-purple-700 text-white h-full flex-shrink-0">
        @include('backend.sidebar')
    </aside>

    <!-- Content Area -->
    <main class="flex-grow overflow-y-auto bg-gray-100">
        @yield('testimonial_dashboard')
    </main>
</div>
</body>
</html>
