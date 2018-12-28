<?php

namespace App\Http\Controllers;
use App\Permissions;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return Permission::all();
    }

    public function createOrEdit()
    {
        return view('permissions');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxpermission = Permission::find($request->id);
        if($auxpermission == null){
            $permission = new Permission();
            $permission->updateOrCreate([
                'permission_name' => $request->permission_name,
                'permission_type' => $request->permission_type
            ],[]);
        }
        else{
            $permission = new Permission();
            $permission->updateOrCreate([
                'id' => $request->id,
            ], 
                ['permission_name' => $request->permission_name,
                'permission_type' => $request->permission_type
            ]);   
        }
        return Permission::all();
    }

    public function show($id)
    {
        return Permission::find($id);
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return Permission::all();
    }
}
