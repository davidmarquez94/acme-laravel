<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Vehicle;
use App\Owner;
use App\Driver;
use SweetAlert;

class VehiclesController extends Controller
{
    public function index(){
        $vehicles = Vehicle::orderBy('id', 'asc')->get();
        return view('layouts.vehicles.index')->with(compact('vehicles'));
    }

    public function create(){
        $drivers = Driver::orderBy('id', 'asc')->get();
        $owners = Owner::orderBy('id', 'asc')->get();
        return view('layouts.vehicles.create')->with(compact('owners', 'drivers'));
    }

    public function store(Request $request){
        dd($request->all());
    }

    public function edit($id){
        $drivers = Driver::orderBy('id', 'asc')->get();
        $owners = Owner::orderBy('id', 'asc')->get();
        $vehicle::find($id);
        return view('layouts.vehicles.edit')->with(compact('drivers', 'owners', 'vehicle'));
    }

    public function update(Request $request){
        dd($request->all());
    }

    public function destroy($id){
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        alert()->success('Se ha eliminado el vehículo de placas "' . $vehicle->plate . '" exitosamente')->autoclose(8000);
        return redirect()->route('vehicles.index');
    }
}
