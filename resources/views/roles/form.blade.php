<div class="grid gap-4 max-w-5xl p-4 md:m-4 border rounded-md shadow bg-white">

    <!-- Role Name -->
    <div class="mb-3">
        <x-label for="name" :value="__('Role Name')" />

        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $role->name"
            required autofocus />
    </div>

    <!-- Permissions -->
    <div class="mb-3">
        <div>Permissions</div>

        <div class="grid grid-cols-4 md:gap-4 p-4 border rounded-lg shadow-sm bg-white">
            @foreach ($permissions as $permission)
            <div class="w-full">
                <input type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    name="permission[]" value="{{ $permission->id }}"
                    {{ in_array($permission->id, $assigns) ? 'checked': '' }} />
                <span class="ml-2 text-sm font-semibold text-gray-600">{{ $permission->name }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Button Group -->
    <div class="flex items-center justify-end mt-4">
        <x-anchor :href="route('roles.index')" />

        <!-- Submit Button -->
        <x-button class="ml-auto">
            {{ __('Save') }}
        </x-button>
    </div>

</div>
@csrf