<x-app-layout>

    <x-slot name="header">
        {{ $admin->name }} Edit
    </x-slot>

    <form method="POST" action="{{ route('admins.update', $admin->id) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admins.form')
    </form>

</x-app-layout>