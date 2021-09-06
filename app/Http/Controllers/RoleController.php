<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Owner|Administrator');
    }

    public function index()
    {
        if (!request()->flag) {
            return view('roles.index');
        }

        $roles = $this->setQuery(Role::query())
            ->search()
            ->getQuery()
            ->where('name', '!=', 'Owner')
            ->where('name', '!=', 'Administrator');

        return view('roles.data', [
            'roles' => $roles->paginate(request()->perpage)
        ]);
    }

    public function create()
    {
        return view('roles.create', [
            'role'          => new Role(),
            'permissions'   => Permission::get(),
            'assigns'       => [],
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create($this->validation($request));

        $role->syncPermissions($request->permission);

        return redirect()
            ->route('roles.show', $role->id)
            ->with('status', 'The record has been successfully created');
    }

    public function show(Role $role)
    {
        if (in_array($role->name, ['Owner', 'Administrator'])) {
            return abort(404);
        }

        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        if (in_array($role->name, ['Owner', 'Administrator'])) {
            return abort(404);
        }

        return view('roles.edit', [
            'role'          => $role,
            'permissions'   => Permission::get(),
            'assigns'       => $role->permissions->pluck('id')->toArray(),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        if (in_array($role->name, ['Owner', 'Administrator'])) {
            return abort(404);
        }

        $role->update($this->validation($request, $role->id));

        $role->syncPermissions($request->permission);

        return redirect()
            ->route('roles.show', $role->id)
            ->with('status', 'The record has been successfully updated');
    }

    public function destroy(Role $role)
    {
        if (in_array($role->name, ['Owner', 'Administrator'])) {
            return abort(404);
        }

        // return $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('status', 'The record has been successfully trashed');
    }

    private function search()
    {
        $this->query
            ->where(function ($query) {
                $query->when(request()->search, function ($query, $search) {
                    $query->where('name', 'regexp', $search);
                });
            });

        return $this;
    }

    private function validation($request, $id = '')
    {
        return $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique(Role::class, 'name')
                    ->ignore($id),
            ],
        ]);
    }
}
