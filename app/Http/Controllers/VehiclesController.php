<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Vehicle;
use App\Owner;
use App\Driver;
use App\Brand;
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
        $brands = Brand::orderBy('id', 'asc')->get();
        return view('layouts.vehicles.create')->with(compact('owners', 'drivers', 'brands'));
    }

    public function store(Request $request){
        $messages = [
            'plate.required' => 'La placa del vehículo es obligatoria',
            'plate.string' => 'La placa del vehículo debe ser una cadena de texto',
            'plate.max' => 'La placa no puede contener más de 6 caracteres',
            'plate.unique' => 'La placa ya está registrada en la base de datos',
            'color.required' => 'El color del vehículo es obligatorio',
            'color.string' => 'El color del vehículo debe ser una cadena de texto',
            'brand_id.required' => 'La marca del vehículo es obligatoria',
            'brand_id.numeric' => 'La marca del vehículo debe ser un valor numérico',
            'brand_id.exists' => 'La marca no está registrada en la base de datos',
            'type.required' => 'El tipo de vehículo es obligatorio',
            'type.string' => 'El tipo de vehículo debe ser una cadena de texto',
            'type.in' => 'El tipo de vehículo solo puede ser particular o Público',
            'owner_id.required' => 'Debe seleccionar el propietario del vehículo',
            'owner_id.numeric' => 'El propietario del vehículo debe ser una valor numérico',
            'owner_id.exists' => 'El propietario del vehículo no está registrado en la base de datos',
            'driver_id.required' => 'Debe seleccionar el conductor del vehículo',
            'driver_id.numeric' => 'El conductor del vehículo debe ser una valor numérico',
            'driver_id.exists' => 'El conductor del vehículo no está registrado en la base de datos',
        ];

        $rules = [
            'plate' => 'required|string|max:6|unique:vehicles',
            'color' => 'required|string',
            'brand_id' => 'required|numeric|exists:brands,id',
            'type' => 'required|string|in:private,public',
            'owner_id' => 'required|numeric|exists:owners,id',
            'driver_id' => 'required|numeric|exists:drivers,id',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            $errors = "";
            foreach($validator->errors()->messages() as $message){
                foreach($message as $error){
                    $errors .= "" . $error . "  //  ";
                }
            }
            alert()->error($errors)->autoclose(8000);
            return back()->withInput();
        } else {
            $data = [
                'plate' => $request->plate,
                'color' => $request->color,
                'brand_id' => $request->brand_id,
                'type' => $request->type,
                'owner_id' => $request->owner_id,
                'driver_id' => $request->driver_id,
            ];
            $vehicle = new Vehicle($data);
            $vehicle->save();

            alert()->success('El vehículo con placas "' . $vehicle->plate . '" ha sido registrado exitosamente')->autoclose(8000);
            return redirect()->route('vehicles.index');
        }
    }

    public function edit($id){
        $drivers = Driver::orderBy('id', 'asc')->get();
        $owners = Owner::orderBy('id', 'asc')->get();
        $brands = Brand::orderBy('id', 'asc')->get();
        $vehicle = Vehicle::find($id);
        return view('layouts.vehicles.edit')->with(compact('drivers', 'owners', 'vehicle', 'brands'));
    }

    public function update(Request $request){
        $messages = [
            'vehicle_id.required' => 'El id del vehículo es obligatorio',
            'vehicle_id.numeric' => 'El id del vehículo debe ser un valor numérico',
            'vehicle_id.exists' => 'El id del vehículo no está registrado en la base de datos',
            'plate.required' => 'La placa del vehículo es obligatoria',
            'plate.string' => 'La placa del vehículo debe ser una cadena de texto',
            'plate.max' => 'La placa no puede contener más de 6 caracteres',
            'color.required' => 'El color del vehículo es obligatorio',
            'color.string' => 'El color del vehículo debe ser una cadena de texto',
            'brand_id.required' => 'La marca del vehículo es obligatoria',
            'brand_id.numeric' => 'La marca del vehículo debe ser un valor numérico',
            'brand_id.exists' => 'La marca no está registrada en la base de datos',
            'type.required' => 'El tipo de vehículo es obligatorio',
            'type.string' => 'El tipo de vehículo debe ser una cadena de texto',
            'type.in' => 'El tipo de vehículo solo puede ser particular o Público',
            'owner_id.required' => 'Debe seleccionar el propietario del vehículo',
            'owner_id.numeric' => 'El propietario del vehículo debe ser una valor numérico',
            'owner_id.exists' => 'El propietario del vehículo no está registrado en la base de datos',
            'driver_id.required' => 'Debe seleccionar el conductor del vehículo',
            'driver_id.numeric' => 'El conductor del vehículo debe ser una valor numérico',
            'driver_id.exists' => 'El conductor del vehículo no está registrado en la base de datos',
        ];

        $rules = [
            'vehicle_id' => 'required|numeric|exists:vehicles,id',
            'plate' => 'required|string|max:6',
            'color' => 'required|string',
            'brand_id' => 'required|numeric|exists:brands,id',
            'type' => 'required|string|in:private,public',
            'owner_id' => 'required|numeric|exists:owners,id',
            'driver_id' => 'required|numeric|exists:drivers,id',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            $errors = "";
            foreach($validator->errors()->messages() as $message){
                foreach($message as $error){
                    $errors .= "" . $error . "  //  ";
                }
            }
            alert()->error($errors)->autoclose(8000);
            return back()->withInput();
        } else {
            $existing_plate = Vehicle::where([
                ['id', '!=', $request->vehicle_id],
                ['plate', '=', $request->plate]
            ])->get();
            if(count($existing_plate) > 0){
                alert()->error('Ya existe otro vehículo con placas "' . $request->plate . '" en la base de datos')->autoclose(8000);
                return back()->withInput();
            } else {
                $vehicle = Vehicle::find($request->vehicle_id);
                $data = [
                    'plate' => $request->plate,
                    'color' => $request->color,
                    'brand_id' => $request->brand_id,
                    'type' => $request->type,
                    'owner_id' => $request->owner_id,
                    'driver_id' => $request->driver_id,
                ];
                $vehicle->fill($data);
                $vehicle->save();

                alert()->success('El vehículo con placas "' . $vehicle->plate . '" ha sido editado exitosamente')->autoclose(8000);
                return redirect()->route('vehicles.index');
            }
        }
    }

    public function destroy($id){
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        alert()->success('Se ha eliminado el vehículo de placas "' . $vehicle->plate . '" exitosamente')->autoclose(8000);
        return redirect()->route('vehicles.index');
    }
}
