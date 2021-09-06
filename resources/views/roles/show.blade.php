<x-app-layout>

    <x-slot name="header">
        {{ $role->name }}
    </x-slot>

    <div class="w-full pb-4 md:p-4 md:pb-0 flex justify-start">
        <a href="{{ route('roles.create') }}"
            class="text-center font-bold cursor-pointer border border-purple-500 text-white hover:bg-purple-600 bg-purple-500 rounded-lg px-3 py-1.5">
            + Add New
        </a>
    </div>

    <div class="overflow-auto md:m-4 mb-4 border rounded-md shadow">
        <table class="bg-white min-w-max w-full table-auto">
            <tr>
                <th class="py-3 px-4 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    Name
                </th>
                <td class="md:w-10/12 py-3 px-4 text-left text-gray-600 text-sm font-bold">
                    {{ $role->name }}
                </td>
            </tr>

            <tr>
                <th class="py-3 px-4 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal align-top">
                    Permissions
                </th>
                <td class="md:w-10/12 py-3 px-4 text-left text-gray-600 text-sm font-bold">
                    @foreach($role->permissions as $permission)
                    {{ $permission->name ?? '' }} <br>
                    @endforeach
                </td>
            </tr>

            <tr>
                <th class="py-3 px-4 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    Actions
                </th>
                <td class="md:w-10/12 py-3 px-4 flex item-center justify-start">
                    <x-action-edit-button :href="route('roles.edit', $role->id)" />
                </td>
            </tr>
        </table>
    </div>

    <div class="mt-4 md:mx-4 flex">
        <x-anchor :href="route('roles.index')" />
    </div>

</x-app-layout>