<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->nombre_usuario,
            'password' => $request->password,
            'user_date_of_birth' => $request->user_date_of_birth,
            'user_phone' => $request->user_phone,
            'user_points' => $request->user_points,   
            'email_verified_at' => $request->email_verified_at,
            'role_id' => $request->role_id,
        ]);
        return User::all();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('edit_user')->with('user', $user);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::find($id)->update([
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->nombre_usuario,
            'password' => $request->password,
            'user_date_of_birth' => $request->user_date_of_birth,
            'user_phone' => $request->user_phone,
            'user_points' => $request->user_points,   
            'email_verified_at' => $request->email_verified_at,
            'role_id' => $request->role_id,
        ]);
        return User::all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
