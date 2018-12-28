<?php

namespace App\Http\Controllers;
use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        return Package::all();
    }

    public function createOrEdit()
    {
        return view('packages');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxpackage = Package::find($request->id);
        if($auxpackage == null){
            $package = new Package();
            $package->updateOrCreate([
                'package_name' => $request->package_name,
                'package_price' => $request->package_price,
                'package_stock' => $request->package_stock,
                'package_type' => $request->package_type,
                'vehicle_id' => $request->vehicle_id
            ],[]);
        }
        else{
            $package = new Package();
            $package->updateOrCreate([
                'id' => $request->id,
            ], 
                ['package_name' => $request->package_name,
                'package_price' => $request->package_price,
                'package_stock' => $request->package_stock,
                'package_type' => $request->package_type,
                'vehicle_id' => $request->vehicle_id
            ]);   
        }
        return Package::all();
    }

    public function show($id)
    {
        return Package::find($id);
    }

    public function destroy($id)
    {
        $package = Package::find($id);
        $package->delete();
        return Package::all();
    }
}

