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
    //Listar vehículos
    public function index(){//Encuentra todos los registros y devuelve al listado principal
        $vehicles = Vehicle::orderBy('id', 'asc')->get();
        return view('layouts.vehicles.index')->with(compact('vehicles'));
    }

    //Crear vehículo
    public function create(){//Busca conductores, marcas y propietarios
        $drivers = Driver::orderBy('id', 'asc')->get();
        $owners = Owner::orderBy('id', 'asc')->get();
        $brands = Brand::orderBy('id', 'asc')->get();
        return view('layouts.vehicles.create')->with(compact('owners', 'drivers', 'brands'));//Regresa al formulario de registro de vehículo
    }

    //Guardar vehículo
    public function store(Request $request){
        $messages = [//Mensajes de error de validación
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

        $rules = [//Reglas de validación
            'plate' => 'required|string|max:6|unique:vehicles',
            'color' => 'required|string',
            'brand_id' => 'required|numeric|exists:brands,id',
            'type' => 'required|string|in:private,public',
            'owner_id' => 'required|numeric|exists:owners,id',
            'driver_id' => 'required|numeric|exists:drivers,id',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);//Ejecuta validador

        if($validator->fails()){//Fallo de validador
            $errors = "";
            foreach($validator->errors()->messages() as $message){
                foreach($message as $error){
                    $errors .= "" . $error . "  //  ";
                }
            }
            alert()->error($errors)->autoclose(8000);
            return back()->withInput();//Devuelve mensaje de error, coloca valores en formulario de nuevo vehículo
        } else {
            $data = [//Datos a insertar
                'plate' => $request->plate,
                'color' => $request->color,
                'brand_id' => $request->brand_id,
                'type' => $request->type,
                'owner_id' => $request->owner_id,
                'driver_id' => $request->driver_id,
            ];
            $vehicle = new Vehicle($data);//Instancia modelo
            $vehicle->save();//Guarda vehículo

            alert()->success('El vehículo con placas "' . $vehicle->plate . '" ha sido registrado exitosamente')->autoclose(8000);
            return redirect()->route('vehicles.index');//Regresa mensaje de error, devuelve al listado general de vehículos
        }
    }

    //Editar vehículo
    public function edit($id){//Encuentra conductores, propietarios y marcas
        $drivers = Driver::orderBy('id', 'asc')->get();
        $owners = Owner::orderBy('id', 'asc')->get();
        $brands = Brand::orderBy('id', 'asc')->get();
        $vehicle = Vehicle::find($id);//Encuentra vehículo por id
        return view('layouts.vehicles.edit')->with(compact('drivers', 'owners', 'vehicle', 'brands'));//Devuelve variables al formulario de edición
    }

    //Actualizar vehículo
    public function update(Request $request){
        $messages = [//Mensajes de error de validación
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

        $rules = [//Reglas de validación
            'vehicle_id' => 'required|numeric|exists:vehicles,id',
            'plate' => 'required|string|max:6',
            'color' => 'required|string',
            'brand_id' => 'required|numeric|exists:brands,id',
            'type' => 'required|string|in:private,public',
            'owner_id' => 'required|numeric|exists:owners,id',
            'driver_id' => 'required|numeric|exists:drivers,id',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);//Ejecuta validador

        if($validator->fails()){//Validador falla
            $errors = "";
            foreach($validator->errors()->messages() as $message){
                foreach($message as $error){
                    $errors .= "" . $error . "  //  ";
                }
            }
            alert()->error($errors)->autoclose(8000);
            return back()->withInput();//Devuelve error al formulario de edición de vehículo
        } else {
            $existing_plate = Vehicle::where([
                ['id', '!=', $request->vehicle_id],
                ['plate', '=', $request->plate]
            ])->get();//Busca vehículo con misma placa y diferente id
            if(count($existing_plate) > 0){
                alert()->error('Ya existe otro vehículo con placas "' . $request->plate . '" en la base de datos')->autoclose(8000);
                return back()->withInput();//Devuelve error si encuentra coincidencias
            } else {
                $vehicle = Vehicle::find($request->vehicle_id);//Encuentra vehículo por id
                $data = [//Datos a actualizar
                    'plate' => $request->plate,
                    'color' => $request->color,
                    'brand_id' => $request->brand_id,
                    'type' => $request->type,
                    'owner_id' => $request->owner_id,
                    'driver_id' => $request->driver_id,
                ];
                $vehicle->fill($data);//Rellena modelo con datos nuevos
                $vehicle->save();//Guarda vehículo

                alert()->success('El vehículo con placas "' . $vehicle->plate . '" ha sido editado exitosamente')->autoclose(8000);
                return redirect()->route('vehicles.index');//Regresa mensaje de éxito a listado de vehículos
            }
        }
    }

    //Borrar vehículo
    public function destroy($id){//Encuentra vehículo por id
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        alert()->success('Se ha eliminado el vehículo de placas "' . $vehicle->plate . '" exitosamente')->autoclose(8000);
        return redirect()->route('vehicles.index');//Borra vehículo y devuelve mensaje de éxito al listado general
    }
}
