<x-app-layout>

    <x-slot name="header">
        {{ __('Role List') }}
    </x-slot>

    <div class="w-full pb-4 md:p-4 md:pb-0 flex justify-start">
        <a href="{{ route('roles.create') }}"
            class="text-center font-bold cursor-pointer border border-purple-500 text-white hover:bg-purple-600 bg-purple-500 rounded-lg px-3 py-1.5">
            + Add New
        </a>
    </div>

    <x-data-table :href="route('roles.index')">
        <tr class="bg-blue-600 text-white uppercase text-sm leading-normal">
            <th class="py-3 px-2 text-center">SL</th>
            <th class="py-3 px-2 text-left">Name</th>
            <th class="py-3 px-2 text-center">Actions</th>
        </tr>
    </x-data-table>

</x-app-layout>