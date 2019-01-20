<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function create()
    {
        return view('users');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxUser = User::find($request->id);
        if($auxUser == null){
            $user = new User();
            $user->updateOrCreate([
                'name' => $request->name,
                'email' => $request->nombre_usuario,
                'password' => $request->password,
                'user_date_of_birth' => $request->user_date_of_birth,
                'user_phone' => $request->user_phone,
                'user_points' => $request->user_points,   
                'email_verified_at' => $request->email_verified_at,
                'role_id' => $request->role_id
            ]);
        }
        else{
            $user = new User();
            $user->updateOrCreate([
                'id' => $request->id,
            ], 
                ['name' => $request->name,
                'email' => $request->nombre_usuario,
                'password' => $request->password,
                'user_date_of_birth' => $request->user_date_of_birth,
                'user_phone' => $request->user_phone,
                'user_points' => $request->user_points,   
                'email_verified_at' => $request->email_verified_at,
                'role_id' => $request->role_id
            ]);   
        }
        return User::all();
    }


   public function show($id)
    {
        return User::find($id);
    }


    public function edit($id)
    {
        $usuario = User::find($id);
        return view('edit_user')->with('user', $user);    
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return User::all();
    }

    /**
    * Display all users Receipts
    * @param int $id
    */
    public function showReceipts($id)
    {
        $user = User::find($id);
        return $user->receipts()->get();
    }
}
