<div class="">
    <!-- Sidebar -->
    <div id="sidebar" class=" bg-purple-700 text-white fixed md:relative h-full md:h-auto transform -translate-x-full md:translate-x-0 transition-transform">
        <div class="h-16 flex items-center justify-between px-4 shadow-sm">
            <h1 class="text-xl font-bold">My App</h1>
            <button id="menu-toggle" class="md:hidden focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        <nav class="px-4 py-4 space-y-2">
            <a href="{{ route('home.dashboard') }}" class="block px-4 py-2 text-white rounded hover:bg-purple-800">Home</a>
            <a href="{{ route('about.dashboard') }}" class="block px-4 py-2 text-white rounded hover:bg-purple-800">About</a>
            <a href="{{ route('service.dashboard') }}" class="block px-4 py-2 text-white rounded hover:bg-purple-800">Service</a>
            <a href="{{ route('portfolio.dashboard') }}" class="block px-4 py-2 text-white rounded hover:bg-purple-800">Portfolio</a>
            <a href="{{ route('testimonial.dashboard') }}" class="block px-4 py-2 text-white rounded hover:bg-purple-800">Testimonial</a>
            <a href="{{ route('socialLink.dashboard') }}" class="block px-4 py-2 text-white rounded hover:bg-purple-800">Social Link</a>
            <a href="{{ route('pricing-plan.index') }}" class="block px-4 py-2 text-white rounded hover:bg-purple-800">Pricing Plan</a>
        </nav>
    </div>

    <!-- Content -->
    <div class="flex-grow ml-0 md:ml-64">
        <!-- Your main content here -->
    </div>
</div>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    });
</script>
