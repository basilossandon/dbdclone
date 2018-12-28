<?php

namespace App\Http\Controllers;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Role::all();
    }


    public function createOrEdit()
    {
        return view('roles');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxRole = Role::find($request->id);
        if($auxRole == null){
            $role = new Role();
            $role->updateOrCreate([
                'role_name' => $request->role_name,
                'role_description' => $request->role_description
            ]);
        }
        else{
            $role = new Role();
            $role->updateOrCreate([
                'id' => $request->id,
            ], 
                ['role_name' => $request->role_name,
                'role_description' => $request->role_description
            ]);   
        }
        return Role::all();
    }

    public function show($id)
    {
        return Role::find($id);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();     
        return Role::all();
    }
}
