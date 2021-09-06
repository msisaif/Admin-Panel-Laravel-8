<x-app-layout>
    <!-- Header -->
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <!-- Page Content -->
    <div class="bg-white shadow border border-gray-200 rounded-lg p-12 m-4">
        <div class="p-4">
            <p class="text-center md:text-2xl text-gray-900 font-bold">{{ Auth::user()->name }}</p>
            <p class="text-center md:text-xl text-gray-500">{{ Auth::user()->email }}</p>
            <p class="text-center md:text-xl text-gray-500">{{ Auth::user()->phone }}</p>
            <p class="text-center md:text-xl text-gray-400 font-bold">
                {{ Auth::user()->adminRole->name ?? '' }}
            </p>
        </div>

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')"
                class="w-32 mx-auto bg-gray-200 text-red-500 text-center border shadow rounded-lg" onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log out') }}
            </x-responsive-nav-link>
        </form>
    </div>

</x-app-layout>