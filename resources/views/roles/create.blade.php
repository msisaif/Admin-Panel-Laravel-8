<x-app-layout>

    <x-slot name="header">
        {{ __('Role Create') }}
    </x-slot>

    <form method="POST" action="{{ route('roles.store') }}">
        @include('roles.form')
    </form>

</x-app-layout>