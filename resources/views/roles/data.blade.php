@forelse ($roles as $role)
<tr class="border-b border-gray-200 hover:bg-gray-100">
    <td class="py-3 px-2 text-center">
        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
            {{ $loop->index + $roles->firstItem() }}
        </span>
    </td>

    <td class="py-3 px-2 text-left">
        <x-text-highlighter :text="$role->name" :highlighter="request()->search" />
    </td>

    <td class="py-3 px-2 text-center">
        <div class="flex item-center justify-center">
            <x-action-show-button :href="route('roles.show', $role->id)" />
            <x-action-edit-button :href="route('roles.edit', $role->id)" />
        </div>
    </td>
</tr>
@empty
<tr>
    <td class="py-3 px-2 text-lg text-center text-red-500" colspan="100">
        <i>No data found !!</i>
    </td>
</tr>
@endforelse

@if($roles->lastPage() > 1)
<tr>
    <td class="py-3 px-2" colspan="100">
        {{ $roles->onEachSide(1)->appends(request()->except('flag'))->links() }}
    </td>
</tr>
@endif