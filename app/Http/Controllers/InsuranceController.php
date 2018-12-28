<?php

namespace App\Http\Controllers;
use App\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index()
    {
        return Insurance::all();
    }

    public function createOrEdit()
    {
        return view('insurances');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxinsurance = Insurance::find($request->id);
        if($auxinsurance == null){
            $insurance = new Insurance();
            $insurance->updateOrCreate([
                'insurance_type' => $request->insurance_type,
                'insurance_price' => $request->insurance_price,
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at
            ],[]);
        }
        else{
            $insurance = new Insurance();
            $insurance->updateOrCreate([
                'id' => $request->id,
            ], 
                ['insurance_type' => $request->insurance_type,
                'insurance_price' => $request->insurance_price,
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at
            ]);   
        }
        return Insurance::all();
    }

    public function show($id)
    {
        return Insurance::find($id);
    }

    public function destroy($id)
    {
        $insurance = Insurance::find($id);
        $insurance->delete();
        return Insurance::all();
    }
}

