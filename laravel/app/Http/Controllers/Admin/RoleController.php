<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    /**
     * List role
     * @return View
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $breadcrumds = [
            'title'      => 'Roles',
            'item'       => [
                [
                    'name' => 'Home',
                    'url'  => route('admin.dashboard'),
                ],
            ],
            'item_final' => 'List',
        ];

        $roles = Role::Where('name', 'like', '%' . $search . '%')->latest()->paginate(2);

        return view('admin.role.index', compact('breadcrumds', 'roles'));
    }

    /**
     * View add role
     * @return View
     */
    public function create(): View
    {
        $breadcrumds = [
            'title'      => 'Roles',
            'item'       => [
                [
                    'name' => 'Home',
                    'url'  => route('admin.dashboard'),
                ],
            ],
            'item_final' => 'Add',
        ];

        return view('admin.role.create', compact('breadcrumds'));
    }

    /**
     *  add role
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(RoleRequest $request)
    {
        try {
            Role::create(['name' => $request->input('name')]);
            return redirect()->route('admin.role.index');
        } catch (Exption $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Detail role
     * @param $id
     * @return View
     */
    public function show($id): View
    {
        $breadcrumds = [
            'title'      => 'Roles',
            'item'       => [
                [
                    'name' => 'Home',
                    'url'  => route('admin.dashboard'),
                ],
            ],
            'item_final' => 'Detail',
        ];
        $role = Role::where('id', $id)->first();

        return view('admin.role.edit', compact('role', 'breadcrumds'));
    }

    /**
     * Update role
     * @param $id
     * @param RoleUpdateRequest $request
     * @return RedirectResponse
     */
    public function updateRole($id, RoleUpdateRequest $request): RedirectResponse
    {
        $role = Role::where('id',$id)->first();
        $role->update(['name' => $request->input('name')]);
        return redirect()->route('admin.role.index')->with('messages','Update success!');
    }

    public function delete()
    {

    }
}
