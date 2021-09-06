<x-app-layout>

    <x-slot name="header">
        {{ __('Admin Create') }}
    </x-slot>

    <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
        @include('admins.form')
    </form>

</x-app-layout>