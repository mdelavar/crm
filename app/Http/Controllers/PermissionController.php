<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }

    /**
     * @param Request $request
     * @return array
     */
    public function userPermissions(User $user)
    {

        $permissions = Permission::all();

        $data = [];

        foreach ($permissions as $pr) {
            $pr->checked = $user->hasPermission($pr->key);
            $data[] = $pr;
        }

        return $data;
    }
    public function updateUserPermissions(User $user , Request $request)
    {
        $permissions = [];
        foreach ($request->get('permissions') as $p) {
            if ($p["checked"]) {
                $permissions[] = $p["id"];
            }
        }
        return $user->permissions()->sync($permissions);
    }

}
