<x-app-layout>

    <x-slot name="header">
        {{ $role->name }} Edit
    </x-slot>

    <form method="POST" action="{{ route('roles.update', $role->id) }}">
        @method('PUT')
        @include('roles.form')
    </form>

</x-app-layout>