<x-app-layout>

    <x-slot name="header">
        {{ __('Admins List') }}
    </x-slot>

    <div class="w-full pb-4 md:p-4 md:pb-0 flex justify-start">
        <a href="{{ route('admins.create') }}"
            class="text-center font-bold cursor-pointer border border-purple-500 text-white hover:bg-purple-600 bg-purple-500 rounded-lg px-3 py-1.5">
            + Add New
        </a>
    </div>

    <x-data-table :href="route('admins.index')" :filter="$filter">
        <tr class="bg-blue-600 text-white uppercase text-sm leading-normal">
            <th class="py-3 px-2 text-center">SL</th>
            <th class="py-3 px-2 text-left">Role</th>
            <th class="py-3 px-2 text-left">Name</th>
            <th class="py-3 px-2 text-left">Phone</th>
            <th class="py-3 px-2 text-left">Email</th>
            <th class="py-3 px-2 text-left">Security</th>
            <th class="py-3 px-2 text-center">Active</th>
            <th class="py-3 px-2 text-center">Actions</th>
        </tr>
    </x-data-table>

</x-app-layout>