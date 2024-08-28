<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        .table-description {
            max-width: 200px; /* Adjust width as needed */
            white-space: nowrap; /* Prevents text wrapping */
            overflow: hidden; /* Hides text overflow */
            text-overflow: ellipsis; /* Adds ellipsis (...) for overflowed text */
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
        @yield('about_dashboard')
    </main>
</div>
</body>
</html>
