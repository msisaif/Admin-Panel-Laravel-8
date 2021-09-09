<x-app-layout>

    <x-slot name="header">
        {{ $admin->name }}
    </x-slot>

    <div class="w-full pb-4 md:p-4 md:pb-0 flex justify-start">
        <a href="{{ route('admins.create') }}" class="text-center font-bold cursor-pointer border border-purple-500 text-white hover:bg-purple-600 bg-purple-500
            rounded-lg px-3 py-1.5">
            + Add New
        </a>
    </div>

    <div class="overflow-auto md:m-4 mb-4 border rounded-md shadow">
        <table class="bg-white min-w-max w-full table-auto">

            <tr>
                <th class="py-3 px-2 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal">

                </th>
                <td class="md:w-10/12 pt-3 px-4 text-left text-gray-600 text-sm font-bold">
                    <x-img-link :src="asset($admin->image->url ?? 'images/profile.png')"
                        class="w-16 md:w-36 h-16 md:h-36 rounded-full border" target="_blank" />
                </td>
            </tr>

            <tr>
                <th class="py-3 px-2 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    Name
                </th>
                <td class="md:w-10/12 py-3 px-4 text-left text-gray-600 text-sm font-bold">
                    <span>{{ $admin->name }}</span>
                </td>
            </tr>
            <tr>
                <th class="py-3 px-2 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    Email
                </th>
                <td class="md:w-10/12 py-3 px-4 text-left text-gray-600 text-sm font-bold">
                    <span>{{ $admin->email }}</span>
                </td>
            </tr>
            <tr>
                <th class="py-3 px-2 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    Security
                </th>
                <td class="md:w-10/12 py-3 px-4 text-left text-gray-600 text-sm font-bold">
                    <span>{{ $admin->security }}</span>
                </td>
            </tr>
            <tr>
                <th class="py-3 px-2 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    Phone
                </th>
                <td class="md:w-10/12 py-3 px-4 text-left text-gray-600 text-sm font-bold">
                    <span>{{ $admin->phone }}</span>
                </td>
            </tr>
            <tr>
                <th class="py-3 px-2 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    Create
                </th>
                <td class="md:w-10/12 py-3 px-4 text-left text-gray-600 text-sm font-light">
                    <span>{{ $admin->created_at->diffForHumans() }}</span>
                </td>
            </tr>

            <tr>
                <th class="py-3 px-2 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal align-top">
                    Role
                </th>
                <td class="md:w-10/12 py-3 px-4 text-left text-gray-600 text-sm font-bold">
                    {{ $admin->adminRole->name ?? '' }}
                </td>
            </tr>

            <tr>
                <th class="py-3 px-2 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    Active
                </th>
                <td class="md:w-10/12 py-3 px-4 text-left text-gray-600 text-sm font-light">
                    <span
                        class="{{ $admin->active ? 'bg-purple-200' : 'bg-red-200' }} text-black py-1 px-3 rounded-full text-xs">
                        {{ $admin->active ? 'Yes' : 'No' }}
                    </span>
                </td>
            </tr>

            <tr>
                <th class="py-3 px-2 text-right bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    Actions
                </th>
                <td class="py-2 px-4 text-left">
                    <div class="flex item-center justify-start">
                        <x-action-edit-button :href="route('admins.edit', $admin->id)" />
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="mt-4 md:mx-4 flex">
        <x-go-back :href="route('admins.index')" />
    </div>

</x-app-layout>