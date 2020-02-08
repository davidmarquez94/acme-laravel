<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Driver;
use SweetAlert;

class DriversController extends Controller
{
    public function index(){
        $drivers = Driver::all();
        return view('layouts.drivers.index')->with(compact('drivers'));
    }

    public function create(){
        return view('layouts.drivers.create');
    }

    public function store(request $request){
        $messages = [
            'first_name.required' => 'El primer nombre es obligatorio',
            'first_name.string' => 'El primer nombre debe ser una cadena de texto',
            'first_name.min' => 'El primer nombre debe tener al menos 3 caracteres',
            'first_name.max' => 'El primer nombre no puede tener más de 10 caracteres',
            'middle_name.required' => 'El segundo nombre es obligatorio',
            'middle_name.string' => 'El segundo nombre debe ser una cadena de texto',
            'middle_name.min' => 'El segundo nombre debe tener al menos 3 caracteres',
            'middle_name.max' => 'El segundo nombre no puede tener más de 10 caracteres',
            'last_name.required' => 'El apellido es obligatorio',
            'last_name.string' => 'El apellido debe ser una cadena de texto',
            'last_name.min' => 'El apellido debe tener al menos 3 caracteres',
            'last_name.max' => 'El apellido no puede tener más de 10 caracteres',
            'address.required' => 'La dirección de residencia es obligatoria',
            'address.string' => 'La dirección de residencia debe ser una cadena de texto',
            'address.max' => 'La dirección de residencia no puede tener más de 30 caracteres',
            'document_number.required' => 'El número de cédula es obligatorio',
            'document_number.min' => 'El número de cédula debe tener al menos 7 caracteres',
            'document_number.unique' => 'El número de cédula ya se encuentra registrado en la base de datos',
            'phone_number.required' => 'El número de teléfono es obligatorio',
            'phone_number.min' => 'El número de teléfono debe tener al menos 7 caracteres',
            'phone_number.max' => 'El número de teléfono no puede tener más de 10 caracteres',
            'license_type.required' => 'El tipo de licencia es obligatorio',
            'license_type.in' => 'El tipo de licencia solo puede ser C1 o B1',
            'city.required' => 'La ciudad es obligatoria',
            'city.string' => 'La ciudad debe ser una cadena de texto'
        ];

        $rules = [
            'first_name' => 'required|string|min:3|max:10',
            'middle_name' => 'required|string|min:3|max:10',
            'last_name' => 'required|string|min:3|max:30',
            'address' => 'required|string|max:30',
            'document_number' => 'required|min:7|unique:drivers',
            'phone_number' => 'required|min:7|max:15',
            'license_type' => 'required|in:C1,B1',
            'city' => 'required|string'
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
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'document_number' => $request->document_number,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'license_type' => $request->license_type,
                'city' => $request->city,
            ];
            $driver = new Driver($data);
            $driver->save();
            alert()->success('Se ha registrado correctamente al conductor "' . $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name . '".')->autoclose(8000);
            return redirect()->route('drivers.index');
        }
    }

    public function edit($id){
        $driver = Driver::find($id);
        return view('layouts.drivers.edit')->with(compact('driver'));
    }

    public function update(Request $request){
        $messages = [
            'driver_id.required' => 'El id del conductor es obligatorio',
            'driver_id.numeric' => 'El id del conductor debe ser un valor numérico',
            'driver_id.exists' => 'El id del conductor debe ser un valor numérico',
            'first_name.required' => 'El primer nombre es obligatorio',
            'first_name.string' => 'El primer nombre debe ser una cadena de texto',
            'first_name.min' => 'El primer nombre debe tener al menos 3 caracteres',
            'first_name.max' => 'El primer nombre no puede tener más de 10 caracteres',
            'middle_name.required' => 'El segundo nombre es obligatorio',
            'middle_name.string' => 'El segundo nombre debe ser una cadena de texto',
            'middle_name.min' => 'El segundo nombre debe tener al menos 3 caracteres',
            'middle_name.max' => 'El segundo nombre no puede tener más de 10 caracteres',
            'last_name.required' => 'El apellido es obligatorio',
            'last_name.string' => 'El apellido debe ser una cadena de texto',
            'last_name.min' => 'El apellido debe tener al menos 3 caracteres',
            'last_name.max' => 'El apellido no puede tener más de 10 caracteres',
            'address.required' => 'La dirección de residencia es obligatoria',
            'address.string' => 'La dirección de residencia debe ser una cadena de texto',
            'address.max' => 'La dirección de residencia no puede tener más de 30 caracteres',
            'document_number.required' => 'El número de cédula es obligatorio',
            'document_number.min' => 'El número de cédula debe tener al menos 7 caracteres',
            'phone_number.required' => 'El número de teléfono es obligatorio',
            'phone_number.min' => 'El número de teléfono debe tener al menos 7 caracteres',
            'phone_number.max' => 'El número de teléfono no puede tener más de 10 caracteres',
            'license_type.required' => 'El tipo de licencia es obligatorio',
            'license_type.in' => 'El tipo de licencia solo puede ser C1 o B1',
            'city.required' => 'La ciudad es obligatoria',
            'city.string' => 'La ciudad debe ser una cadena de texto'
        ];

        $rules = [
            'driver_id' => 'required|numeric|exists:drivers,id',
            'first_name' => 'required|string|min:3|max:10',
            'middle_name' => 'required|string|min:3|max:10',
            'last_name' => 'required|string|min:3|max:30',
            'address' => 'required|string|max:30',
            'document_number' => 'required|min:7',
            'phone_number' => 'required|min:7|max:15',
            'license_type' => 'required|in:C1,B1',
            'city' => 'required|string'
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
            $existing_document = Driver::where([
                ['document_number', '=',$request->document_number],
                ['id', '!=', $request->driver_id]
            ])->get();
            if(count($existing_document) > 0){
                alert()->error('Ya existe otro conductor con el número de documento "' . $request->document_number . '".')->autoclose(8000);
            }
            $driver = Driver::find($request->driver_id);
            $data = [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'document_number' => $request->document_number,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'license_type' => $request->license_type,
                'city' => $request->city,
            ];
            $driver->fill($data);
            $driver->save();
            alert()->success('Se ha editado correctamente al conductor "' . $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name . '".')->autoclose(8000);
            return redirect()->route('drivers.index');
        }
    }

    public function destroy($id){
        $driver = Driver::where('id', $id)->with(['vehicle'])->first();
        if($driver->vehicle == null){
            $driver->delete();
            alert()->success('Se ha eliminado el conductor "' . $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name . '".')->autoclose(8000);
            return redirect()->route('drivers.index');
        } else {
            alert()->error('Este conductor tiene un vehículo asociado, y no es posible eliminarlo.')->autoclose(8000);
            return redirect()->route('drivers.index');
        }
    }
}
