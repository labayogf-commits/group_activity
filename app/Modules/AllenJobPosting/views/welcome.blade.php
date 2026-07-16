<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JBM System | Find Your Dream Job</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <nav class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
        <div class="text-2xl font-bold tracking-tight text-indigo-600">JBM<span class="text-gray-900">System</span></div>
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">Log in</a>
                <a href="{{ route('register') }}" class="text-sm font-bold bg-gray-900 text-white px-5 py-2.5 rounded-xl hover:bg-gray-800 transition">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Hero -->
    <header class="max-w-7xl mx-auto px-6 py-16 text-center">
        <h1 class="text-6xl font-extrabold text-gray-950 mb-6 tracking-tight">Your next career move <br>starts here.</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-10">Discover hand-picked job opportunities from top companies. Browse now and apply once you're ready.</p>
    </header>

    <section class="max-w-5xl mx-auto px-6 pb-20">
    <h2 class="text-2xl font-bold mb-8">Latest Opportunities</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($jobs as $job)
            <!-- Start of Job Card -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-bold text-lg text-gray-950">{{ $job->title }}</h3>
                        <p class="text-sm font-medium text-indigo-600">{{ $job->company_name ?? 'Company Name' }}</p>
                    </div>
                    <!-- UPDATED: Dynamic Job Type Badge -->
                    <span class="text-[10px] font-bold uppercase tracking-widest bg-indigo-50 text-indigo-700 border border-indigo-100 px-2 py-1 rounded-md">
                        {{ $job->job_type ?? 'N/A' }}
                    </span>
                </div>
                
                <p class="text-sm text-gray-500 mb-6 line-clamp-2">
                    {{ $job->description ?? 'No description provided for this position.' }}
                </p>

                <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                    <span class="text-xs font-medium text-gray-400">{{ $job->location ?? 'Location' }}</span>
                    <a href="{{ route('login') }}" class="text-xs font-bold bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition">
                        Login to Apply
                    </a>
                </div>
            </div>
            <!-- End of Job Card -->
        @empty
            <p class="text-gray-500">No jobs available right now.</p>
        @endforelse
    </div>
</section>  

</body>
</html>