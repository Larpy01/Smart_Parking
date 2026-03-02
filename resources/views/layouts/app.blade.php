<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/svg+xml"
          href="data:image/svg+xml,<svg xmlns='https://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='50' fill='%23f97316'/><text x='50%25' y='50%25' text-anchor='middle' fill='white' font-family='sans-serif' font-weight='bold' font-size='60' dy='.3em'>P</text></svg>">

    <title>@yield('title', 'Smart Parking')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <style>
        /* BASE THEME COLORS */
        :root {
            --primary: #f97316;
            --primary-hover: #ea580c;
            --blue: #2563eb;
            --blue-hover: #1d4ed8;
            --bg-gray: #f3f4f6;
            --sidebar-green: #dcfce7;
            --sidebar-hover: #bbf7d0;
            --text-dark: #111827;
            --text-muted: #6b7280;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            margin: 0;
            background-color: var(--bg-gray);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* UTILITIES */
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .flex-1 { flex: 1; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .hidden { display: none; }
        .p-4 { padding: 1rem; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .gap-2 { gap: 0.5rem; }
        .shadow-sm { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }

        /* HEADER */
        .app-header {
            background: white;
            position: sticky;
            top: 0;
            z-index: 50;
            height: 64px;
            border-bottom: 1px solid #e5e7eb;
        }

        .header-container {
            max-width: 1280px;
            margin: 0 auto;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn-blue {
            background: var(--blue);
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        /* SIDEBAR */
        #sidebar {
            width: 256px;
            background: var(--sidebar-green);
            border-right: 1px dotted #ccc;
            transition: width 0.3s;
            overflow-x: hidden;
        }

        #sidebar.w-16 { width: 64px; }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            color: #374151;
            text-decoration: none;
            font-size: 14px;
            border-radius: 6px;
            transition: 0.2s;
            white-space: nowrap;
        }

        .sidebar-link:hover {
            background: var(--sidebar-hover);
            color: var(--primary);
        }

        .sidebar-header {
            height: 60px;
            padding: 0 16px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        /* ICONS */
        .icon-p {
            height: 32px;
            width: 32px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* FORMS & ERRORS */
        .border-red-500 { border: 1px solid #ef4444 !important; }
        .text-red-500 { color: #ef4444; font-size: 12px; }

        footer {
            background: white;
            border-top: 1px solid #e5e7eb;
            padding: 24px 0;
            text-align: center;
            color: var(--text-muted);
            font-size: 14px;
        }
    </style>
    @stack('styles')
</head>

<body>

@guest
    @if (!Route::is('login') && !Route::is('register') && !Route::is('password.request') && !Route::is('password.reset'))
        <header class="app-header shadow-sm">
            <div class="header-container px-4">
                <a href="{{ route('landing') }}" class="flex items-center gap-2" style="text-decoration: none; color: inherit; font-weight: 600;">
                    <span class="icon-p">P</span>
                    <span>Smart Parking</span>
                </a>
                <nav class="flex items-center gap-2">
                    <a href="{{ route('login') }}" class="btn-blue">Login</a>
                    <a href="{{ route('register') }}" style="color: var(--blue); text-decoration: none; font-size: 14px; font-weight: 600;">Register</a>
                </nav>
            </div>
        </header>
    @endif

    <main class="flex-1">
        <div style="max-width: 1280px; margin: 0 auto; padding: 32px 16px;">
            @yield('content')
        </div>
    </main>
@endguest

@auth
<div class="flex flex-1" style="overflow: hidden;">
    <aside id="sidebar">
        <div class="sidebar-header">
            <span class="sidebar-text" style="font-weight: 600; font-size: 18px;">Smart Parking</span>
            <button id="sidebarToggle" style="background: none; border: none; cursor: pointer; margin-left: auto;">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <nav class="p-4" style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
            @if (auth()->user()->hasAdminAccess())
                <p class="sidebar-text" style="font-size: 10px; font-weight: bold; color: #9ca3af; text-transform: uppercase;">Administration</p>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">Admin Panel</a>
                <a href="{{ route('admin.parking-locations.index') }}" class="sidebar-link">Parking Locations</a>
                <a href="{{ route('admin.parking-slots.index') }}" class="sidebar-link">Parking Slots</a>
            @else
                <a href="{{ route('home') }}" class="sidebar-link">Dashboard</a>
                <a href="{{ route('parking.index') }}" class="sidebar-link">Parking</a>
                <a href="{{ route('vehicles.index') }}" class="sidebar-link">My Vehicles</a>
            @endif
        </nav>

        <div style="border-top: 1px solid rgba(0,0,0,0.05);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer; padding: 16px;">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="sidebar-text" style="margin-left: 12px;">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1" style="overflow-y: auto; background: #f9fafb;">
        @if (!Route::is('profile.edit'))
            <header style="background: #bbf7d0; height: 60px; display: flex; items-center; justify-between; padding: 0 16px; border-bottom: 1px dotted #ccc;">
                <div class="flex items-center gap-2">
                    <span class="icon-p">P</span>
                    <span style="font-weight: 600; font-size: 20px;">@yield('title')</span>
                </div>
                <div class="flex items-center gap-2">
                    <span style="font-size: 14px; color: #4b5563;">{{ auth()->user()->name }}</span>
                    <a href="{{ route('profile.edit') }}">
                        <img src="{{ auth()->user()->profile_picture_url }}" style="height: 32px; width: 32px; border-radius: 50%; object-fit: cover; border: 1px solid #ddd;">
                    </a>
                </div>
            </header>
        @endif

        <div style="padding: 40px 16px;">
            @yield('content')
        </div>
    </main>
</div>
@endauth

@if (!Route::is('login') && !Route::is('register'))
    <footer>
        <div class="header-container px-4">
            <span>&copy; {{ date('Y') }} Smart Parking</span>
            <div class="flex gap-2">
                <a href="{{ route('privacy') }}" style="color: inherit; text-decoration: none;">Privacy</a>
                <a href="{{ route('terms') }}" style="color: inherit; text-decoration: none;">Terms</a>
            </div>
        </div>
    </footer>
@endif

<script>
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');
    toggle?.addEventListener('click', () => {
        sidebar.classList.toggle('w-16');
        document.querySelectorAll('.sidebar-text').forEach(el => el.classList.toggle('hidden'));
    });
</script>

@stack('scripts')
</body>
</html>