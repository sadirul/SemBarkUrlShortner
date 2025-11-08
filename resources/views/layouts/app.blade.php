<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'URL Shortener')</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 16px;
            border-bottom: 1px solid #eee;
            background: #fff;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand {
            font-weight: 700;
            letter-spacing: .3px;
        }

        .spacer {
            flex: 1;
        }

        nav.nav {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* base links */
        .nav a,
        .nav button.linklike {
            text-decoration: none;
            padding: 8px 10px;
            border-radius: 6px;
            color: #222;
            font: inherit;
            background: transparent;
            border: 0;
            cursor: pointer;
        }

        .nav a:hover,
        .nav button.linklike:hover {
            background: #f2f2f2;
        }

        /* dropdown */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            /* sits flush under the trigger – no gap */
            background: #fff;
            padding: 6px 0;
            min-width: 180px;
            border: 1px solid #eee;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
            border-radius: 6px;
            z-index: 100;
        }

        .dropdown-menu a {
            display: block;
            padding: 8px 12px;
            color: #222;
            text-decoration: none;
            border-radius: 0;
        }

        .dropdown-menu a:hover {
            background: #f7f7f7;
        }

        /* show menu on hover OR keyboard focus OR JS toggle */
        .dropdown:hover .dropdown-menu,
        .dropdown:focus-within .dropdown-menu,
        .dropdown.open .dropdown-menu {
            display: block;
        }

        .logout-btn {
            border: 1px solid #ddd;
            background: #fff;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: #f7f7f7;
        }

        main {
            padding: 16px;
        }

        @media (max-width: 520px) {
            header {
                flex-wrap: wrap;
            }

            .spacer {
                display: none;
            }

            nav.nav {
                width: 100%;
                order: 3;
                padding-top: 6px;
                flex-wrap: wrap;
            }

            .dropdown-menu {
                position: static;
                display: none;
                box-shadow: none;
                border: 0;
                padding: 0;
            }

            .dropdown.open .dropdown-menu {
                display: block;
            }
        }

        /* optional: active state */
        .active {
            background: #f2f2f2;
        }

        .error {
            color: #b42318;
            font-size: 12px;
            margin-top: 6px;
        }
    </style>
</head>

<body>
    <header>
        <div class="brand">URL Shortner</div>

        <nav aria-label="Main" class="nav">
            <a href="{{ route('dashboard.index') }}"
                class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">Dashboard</a>
            @if (auth()->user()->role == 'SuperAdmin')
                <div class="dropdown" data-dropdown>
                    <!-- use button so we can toggle on mobile -->
                    <button type="button" class="linklike {{ request()->routeIs('company.*') ? 'active' : '' }}"
                        aria-haspopup="true" aria-expanded="false" data-dropdown-trigger>
                        Company
                    </button>

                    <div class="dropdown-menu" role="menu">
                        <a href="{{ route('company.create') }}" role="menuitem">Add Company</a>
                        <a href="{{ route('company.index') }}" role="menuitem">All Companies</a>
                    </div>
                </div>
            @endif

            @if (in_array(auth()->user()->role, ['SuperAdmin', 'Admin']))
                <div class="dropdown" data-dropdown>
                    <!-- use button so we can toggle on mobile -->
                    <button type="button" class="linklike {{ request()->routeIs('admin.*') ? 'active' : '' }}"
                        aria-haspopup="true" aria-expanded="false" data-dropdown-trigger>
                        Users
                    </button>

                    <div class="dropdown-menu" role="menu">
                        <a href="{{ route('admin.create') }}" role="menuitem">Add User</a>
                        <a href="{{ route('admin.index') }}" role="menuitem">All User</a>
                    </div>
                </div>
            @endif

            
            @if (in_array(auth()->user()->role, ['Member', 'Admin']))
                    <a href="{{ route('url.create') }}" class="linklike {{ request()->routeIs('url.*') ? 'active' : '' }}"
                        aria-haspopup="true" aria-expanded="false" data-dropdown-trigger>
                        Generate URL
                    </a>

          
            @endif
        </nav>

        <div class="spacer"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- Tiny JS to support click-to-toggle and click-outside (mobile-friendly) --}}
    <script>
        (function() {
            const dropdown = document.querySelector('[data-dropdown]');
            if (!dropdown) return;

            const trigger = dropdown.querySelector('[data-dropdown-trigger]');

            // Click to toggle
            trigger.addEventListener('click', function(e) {
                const isOpen = dropdown.classList.contains('open');
                dropdown.classList.toggle('open', !isOpen);
                trigger.setAttribute('aria-expanded', String(!isOpen));
            });

            // Close when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove('open');
                    trigger.setAttribute('aria-expanded', 'false');
                }
            });

            // Optional: close on Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    dropdown.classList.remove('open');
                    trigger.setAttribute('aria-expanded', 'false');
                    trigger.blur();
                }
            });
        })();
    </script>
</body>

</html>
