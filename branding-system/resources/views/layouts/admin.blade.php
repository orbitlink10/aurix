<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: #0b1021; color: #e9ecf2; }
        .card { background: #10172a; border: 1px solid #1f2a44; }
        .card h2 { color: #b3c5ff; }
        .nav-link { color: #cfd8f3; }
        .nav-link:hover { color: #7dd3fc; }
        .pill { background: #1f2a44; color: #9db6ff; }
        .btn { transition: all 0.15s ease; }
    </style>
</head>
<body class="min-h-screen">
    <header class="border-b border-slate-800 sticky top-0 bg-[#0b1021]/95 backdrop-blur z-10">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-semibold text-white">Aurix Admin</a>
                <nav class="flex items-center gap-4 text-sm">
                    <a class="nav-link" href="{{ route('admin.services.index') }}">Services</a>
                    <a class="nav-link" href="{{ route('admin.packages.index') }}">Packages</a>
                    <a class="nav-link" href="{{ route('admin.leads.index') }}">Leads</a>
                    <a class="nav-link" href="{{ route('admin.orders.index') }}">Orders</a>
                    <a class="nav-link" href="{{ route('admin.blog-posts.index') }}">Blog</a>
                    <a class="nav-link" href="{{ route('admin.reports.index') }}">Reports</a>
                </nav>
            </div>
            <div class="flex items-center gap-3 text-sm">
                <span class="pill px-3 py-1 rounded-full">{{ auth()->user()->name ?? 'Guest' }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn bg-sky-500 hover:bg-sky-400 text-slate-900 px-3 py-1 rounded">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-6 space-y-4">
        @if (session('success'))
            <div class="card p-3 text-emerald-300 border-emerald-700">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="card p-3 text-rose-300 border-rose-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
