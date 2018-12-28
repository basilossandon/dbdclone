<?php

namespace App\Http\Controllers;
use App\Register;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return Register::all();
    }

    public function createOrEdit()
    {
        return view('registers');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxRegister = Register::find($request->id);
        if($auxRegister == null){
            $register = new Register();
            $register->updateOrCreate([
                'user_id' => $request->user_id,
                'modified_table_name' => $request->modified_table_name,
                'modification' => $request->modification
            ]);
        }
        else{
            $register = new Register();
            $register->updateOrCreate([
                'id' => $request->id,
            ], 
                ['user_id' => $request->user_id,
                'modified_table_name' => $request->modified_table_name,
                'modification' => $request->modification
            ]);   
        }
        return Register::all();
    }

    public function show($id)
    {
        return Register::find($id);
    }


    public function destroy($id)
    {
        $register = Register::find($id);
        $register->delete();
        return Register::all();
    }

