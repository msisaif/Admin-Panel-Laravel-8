@forelse ($admins as $admin)
<tr class="border-b border-gray-200 hover:bg-gray-100">
    <td class="py-3 px-4 text-center">
        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
            {{ ($admins->total() + 1) - ($loop->index + $admins->firstItem()) }}
        </span>
    </td>

    <td class="py-3 px-4 text-left">
        <x-text-highlighter :text="$admin->adminRole->name ?? ''" :highlighter="request()->search" />
    </td>

    <td class="py-3 px-4 text-left">
        <div class="flex items-center">
            <x-img-link :src="asset($admin->image->url ?? 'images/profile.png')" class="w-8 h-8 rounded-full border"
                target="_blank" />
            <span class="ml-2">
                <x-text-highlighter :text="$admin->name" :highlighter="request()->search" />
            </span>
            @if(Auth::id() == $admin->id)
            <span class="ml-2 text-red-500 font-bold">(You)</span>
            @endif
        </div>
    </td>

    <td class="py-3 px-4 text-left">
        <x-text-highlighter :text="$admin->phone" :highlighter="request()->search" />
    </td>

    <td class="py-3 px-4 text-left">
        <x-text-highlighter :text="$admin->email" :highlighter="request()->search" />
    </td>

    <td class="py-3 px-4 text-left">
        <x-text-highlighter :text="$admin->security" :highlighter="request()->search" />
    </td>

    <td class="py-3 px-4 text-center">
        <span
            class="{{ $admin->active ? 'bg-purple-200' : 'bg-red-200' }} text-purple-600 py-1 px-3 rounded-full text-xs">
            {{ $admin->active ? 'Yes' : 'No' }}
        </span>
    </td>

    <td class="py-3 px-4 text-center">
        <div class="flex item-center justify-center">
            <x-action-show-button :href="route('admins.show', $admin->id)" />
            <x-action-edit-button :href="route('admins.edit', $admin->id)" />
        </div>
    </td>
</tr>
@empty
<tr>
    <td class="py-3 px-4 text-lg text-center text-red-500" colspan="100">
        <i>No data found !!</i>
    </td>
</tr>
@endforelse

@if($admins->lastPage() > 1)
<tr>
    <td class="py-3 px-4 text-center" colspan="100">
        {{ $admins->onEachSide(1)->appends(request()->except('flag'))->links() }}
    </td>
</tr>
@endif