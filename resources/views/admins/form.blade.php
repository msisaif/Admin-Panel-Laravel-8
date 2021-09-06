<div class="grid gap-4 max-w-sm p-4 md:m-4 border rounded-md shadow bg-white">

    <!-- Image -->
    <div class="mt-1 w-full">
        <x-img-link id="imagePreviewer" src="{{ asset($admin->image->url ?? 'images/profile.png') }}"
            class="w-36 h-36 border rounded-full" target="_blank" />

        <div class="mt-2">
            <x-image-crop name="image" preview="#imagePreviewer" />
        </div>
    </div>

    <!-- Nmae -->
    <div class="mt-1">
        <x-label for="name" :value="__('Name')" />

        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $admin->name"
            required autofocus />
    </div>

    <!-- Email Address -->
    <div class="mt-1">
        <x-label for="email" :value="__('Email')" />

        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email') ?? $admin->email"
            required autofocus />
    </div>

    <!-- Phone -->
    <div class="mt-1">
        <x-label for="phone" :value="__('Phone')" />

        <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone') ?? $admin->phone"
            required autocomplete="off" />
    </div>

    <!-- Password -->
    <div class="mt-1">
        <x-label for="password" :value="__('Password')" />

        <x-input-password id="password" class="block mt-1 w-full" type="password" name="password"
            :value="old('password') ?? $admin->security" required autocomplete="off" />
    </div>

    <!-- Active -->
    <div class="mt-1">
        <x-label for="active" :value="__('Active')" />

        <x-select id="active" class="block mt-1 w-full" name="active" required>
            <option value="1" {{ old('active') ?? $admin->active == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('active') ?? $admin->active == '0' ? 'selected' : '' }}>No</option>
        </x-select>
    </div>


    <!-- Roles -->
    <div class="mb-3">
        <div>Roles</div>

        <div class="grid md:gap-1 px-2.5 py-1.5 border rounded-lg shadow-sm bg-white">
            @foreach ($roles as $role)
            <div class="w-full">
                <input type="radio"
                    class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    name="role" value="{{ $role->id }}"
                    {{ ($admin->adminRole->id ?? '') === $role->id  ? 'checked': '' }} />
                <span class="ml-2 text-sm font-semibold text-gray-600">{{ $role->name }}</span>
            </div>
            @endforeach
        </div>
    </div>


    <!-- Button Group -->
    <div class="flex items-center justify-end my-6 col-span-full">
        <x-anchor :href="route('admins.index')" />

        <!-- Submit Button -->
        <x-button class="ml-auto">
            {{ __('Save') }}
        </x-button>
    </div>

</div>

@csrf