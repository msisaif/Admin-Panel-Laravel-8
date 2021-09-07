<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Owner|Administrator');
    }

    public function index()
    {
        if (!request()->flag) {
            return view('admins.index', [
                'filter' => $this->filterProperty()
            ]);
        }

        $admins = $this->setQuery(Admin::query())
            ->search()->filter()
            ->getQuery();

        return view('admins.data', [
            'admins' => $admins->paginate(request()->perpage)
        ]);
    }

    public function create()
    {
        return view('admins.create', [
            'admin' => new Admin(),
            'roles' => Role::query()
                ->when(!Auth::user()->hasRole('Owner'), function ($query) {
                    $query->where('name', '!=', 'Owner');
                })
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $admin = Admin::create($this->validation($request) + [
            'password' => Hash::make($request->password),
            'security' => $request->password
        ]);

        $this->uploadImageableImage($request->image, $admin, 'admins', true);

        $this->assignRole($admin, $request->role);

        return redirect()
            ->route('admins.show', $admin->id)
            ->with('status', 'The record has been successfully created');
    }

    public function show(Admin $admin)
    {
        return view('admins.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        if (!Auth::user()->hasRole('Owner') && $admin->hasRole('Owner')) {
            return abort(404);
        }

        return view('admins.edit', [
            'admin' => $admin,
            'roles' => Role::query()
                ->when(!Auth::user()->hasRole('Owner'), function ($query) {
                    $query->where('name', '!=', 'Owner');
                })
                ->get(),
        ]);
    }

    public function update(Request $request, Admin $admin)
    {
        if (!Auth::user()->hasRole('Owner') && $admin->hasRole('Owner')) {
            return abort(404);
        }

        $admin->update($this->validation($request, $admin->id) + [
            'password' => Hash::make($request->password),
            'security' => $request->password
        ]);

        $this->uploadImageableImage($request->image, $admin, 'admins', true);

        $this->assignRole($admin, $request->role);

        return redirect()
            ->route('admins.show', $admin->id)
            ->with('status', 'The record has been successfully updated');
    }

    public function destroy(Admin $admin)
    {
        if (!Auth::user()->hasRole('Owner') && $admin->hasRole('Owner')) {
            return abort(404);
        }

        // $customer->delete();

        return redirect()
            ->route('admins.index')
            ->with('status', 'The record has been successfully trashed');
    }

    private function search()
    {
        $this->getQuery()
            ->where(function ($query) {
                $query->when(request()->search, function ($query, $search) {
                    $query
                        ->where('name', 'regexp', $search)
                        ->orWhere('email', 'regexp', $search)
                        ->orWhere('phone', 'regexp', $search)
                        ->orWhereHas('roles', function ($query) use ($search) {
                            $query->where('name', 'regexp', $search);
                        });
                });
            });

        return $this;
    }

    private function filterProperty()
    {
        return [
            'role' => Role::orderBy('id')->pluck('name', 'id'),
            'active' => ['Yes' => 'Yes', 'No' => 'No'],
        ];
    }

    private function filter()
    {
        $this->getQuery()
            ->when(request()->active, function ($query, $active) {
                $query->where('active', $active == 'Yes' ? 1 : 0);
            })
            ->when(request()->role, function ($query, $role_id) {
                $query->whereHas('roles', function ($query) use ($role_id) {
                    $query->where('id', $role_id);
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
            ],

            'email' => [
                'required',
                'string',
                'email',
                Rule::unique(Admin::class, 'email')->ignore($id),
            ],

            'phone' => [
                'required',
                'numeric',
                Rule::unique(Admin::class, 'phone')->ignore($id),
            ],

            'active' => [
                'required',
                'numeric'
            ],
        ]);
    }

    private function assignRole($admin, $role)
    {
        if (($role == 1 && Auth::user()->hasRole('Owner')) || $role != 1) {
            $admin->syncRoles($role);
        }
    }
}
