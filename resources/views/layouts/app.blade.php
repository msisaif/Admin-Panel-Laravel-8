<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Panel' }}</title>


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{ $style ?? '' }}
</head>

<body class="overflow-y-auto">
    <header>
        <div class="flex justify-between py-2 bg-blue-600 text-white z-40">
            <!-- Menu Button -->
            <div class="mx-4">
                <svg id="menuButton" class="w-8 h-8 cursor-pointer z-40" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </div>

            <!-- Heading -->
            <div class="flex-grow flex justify-center items-center">
                <h3 class="font-semibold text-center text-sm md:text-xl leading-tight">
                    {{ $header ?? '' }}
                </h3>
            </div>


            <!-- Logout Button -->
            <div class="mx-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-white bg-red-500 hover:bg-red-600 rounded-full w-8 h-8 flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </header>
    <div class="overflow-auto">
        <div class="flex">
            <div id="sidebarContainer" class="hidden md:block z-30">
                <nav>
                    <div class="w-screen h-full min-h-screen md:w-auto min-w-max bg-blue-700 p-4 flex flex-col">
                        @include('layouts.navigation')
                    </div>
                </nav>
            </div>
            <div class="flex-auto overflow-auto z-30">
                <main>
                    <!-- Flash Message -->
                    <div id="flashMessage">
                        <!-- Validation Errors -->
                        <x-auth-session-status class="md:text-xl px-4 py-3 md:mx-4 mt-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="md:text-xl px-4 py-3 md:mx-4 mt-4" :errors="$errors" />
                    </div>

                    <div class="w-full p-4">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        //sidebar menu
        const sidebarContainer = document.getElementById('sidebarContainer')
        const menuButton = document.getElementById('menuButton')

        menuButton.onclick = function()
        {
            sidebarContainer.classList.toggle('hidden')
            sidebarContainer.classList.toggle('md:block')
            sidebarContainer.classList.toggle('md:hidden')
        }

        //auto hide flash message
        setTimeout(function () {document.querySelector('#flashMessage').style.display='none'}, 5000)

    </script>

    {{ $script ?? '' }}
</body>

</html>