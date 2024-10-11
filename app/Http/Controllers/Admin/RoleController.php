<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Enums\PermissionGroup;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Role::withCount(['permissions']);
            // dd($data);

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '';
                })
                ->editColumn('created_at', function ($row) {
                    // dd($row);
                    if (!empty($row->created_at)) {
                        return Carbon::parse($row->created_at)->format('d-m-Y');
                    }
                })
                ->editColumn('updated_at', function ($row) {
                    // dd($row);
                    if (!empty($row->created_at)) {
                        return Carbon::parse($row->updated_at)->format('d-m-Y');
                    }
                })
                ->make(true);
        } else {

            $permissions = Permission::get()->toArray();

            $group_permissions = collect(PermissionGroup::getValues())
                ->mapWithKeys(function ($value) {
                    return [$value => PermissionGroup::getDescription($value)];
                })
                ->toArray();

            $arr_permissions = [];

            foreach ($group_permissions as $key => $value) {
                foreach ($permissions as $permission) {
                    if ($permission['group_name'] == $key) {
                        $arr_permissions[$value][] = $permission;
                    }
                }
            }

            return view('admins.role.role', [
                "arr_permissions" => $arr_permissions,
            ]);
        }
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
    public function store(Request $request)
    {
        $permission = $request->permission;

        $role = Role::create([
            'name' => $request->name
        ]);


        if (!empty($permission)) {
            $permissions = Permission::whereIn('id', $permission)->get();
            $role->givePermissionTo($permissions);
        }

        return response()->json([
            'success' => 'tạo thành công'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            // $data = Role::FindOrFail($id);
            $role = Role::findOrFail($id)->load('permissions');

            $permissions = Permission::get()->toArray();

            $group_permissions = collect(PermissionGroup::getValues())
                ->mapWithKeys(function ($value) {
                    return [$value => PermissionGroup::getDescription($value)];
                })
                ->toArray();
            // dd()

            $arr_permissions = [];

            foreach($group_permissions as $key => $value) {
                foreach($permissions as $permission) {
                    if ($permission['group_name'] == $key) {
                        $arr_permissions[$value][] = $permission;
                    }
                }
            }

            return view('admins.role.show', [
                "arr_permissions" => $arr_permissions,
                "role" => $role,
                "permissions" => $role->permissions->pluck('id')->toArray(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $permission = $request->permission;

            $role = Role::find($id);
            $role->update([
                'name'=>$request->name
            ]);

            if(!empty($permission)) {
                $permissions = Permission::whereIn('id', $permission)->get();
                $role->syncPermissions($permissions);
            }

            return response()->json([
            'success'=>'đã cập nhập thành công'
            ]);
        } catch(Exception $e){
            return response()->json([
                'error'=> $e->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
