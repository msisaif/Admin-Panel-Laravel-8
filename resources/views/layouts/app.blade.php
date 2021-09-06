<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Nilkhet' }}</title>


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{ $style ?? '' }}
</head>

<body class="font-sans antialiased min-h-screen bg-gray-50">
    <nav id="sidebarWrapper"
        class="bg-blue-600 md:static absolute right-full top-16 min-w-max py-4 px-4 flex flex-col md:flex-row justify-center bg-white z-10">
        @include('layouts.navigation')
    </nav>
    <header class="relative shadow border-b border-t md:px-4 bg-white">
        <svg id="menuButton" class="w-8 absolute left-4 top-4 md:hidden text-blue-600 cursor-pointer z-40"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>

        <div class="py-4 flex justify-between items-center">
            <div class="flex-auto pr-5 pl-8 md:pl-5">
                <h2 class="font-semibold text-center text-sm md:text-xl text-blue-600 leading-tight">
                    {{ $header ?? '' }}
                </h2>
            </div>
            <div class="px-2 md:px-5">
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

    <main>

        <!-- Flash Message -->
        <div id="flashMessage">
            @if(session('status'))
            <div
                class="text-white md:text-xl px-4 py-3 border-0 rounded-md shadow relative md:mx-4 mt-4 {{ session('class') ?? 'bg-green-500' }}">
                {{ session('status') }}
            </div>
            @endif

            <!-- Validation Errors -->
            <x-auth-validation-errors class="md:text-xl px-4 py-3 md:mx-4 mt-4" :errors="$errors" />
        </div>

        <div class="w-full p-4">
            {{ $slot }}
        </div>
    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        //sidebar menu
            const sidebarWrapper = document.getElementById('sidebarWrapper')
            const menuButton = document.getElementById('menuButton')

            menuButton.onclick = function()
            {
                sidebarWrapper.classList.toggle('right-full')
                sidebarWrapper.classList.toggle('w-full')
                sidebarWrapper.classList.toggle('left-0')
            }

            //auto hide flash message
            setTimeout(function () {document.querySelector('#flashMessage').style.display='none'}, 5000)

    </script>

    {{ $script ?? '' }}
</body>

</html>