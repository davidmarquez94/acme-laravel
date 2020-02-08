<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Owner;
use SweetAlert;

class OwnersController extends Controller
{
    public function index(){
        $owners = Owner::all();
        return view('layouts.owners.index')->with(compact('owners'));
    }

    public function create(){
        return view('layouts.owners.create');
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
                'city' => $request->city,
            ];
            $owner = new Owner($data);
            $owner->save();
            alert()->success('Se ha registrado correctamente al propietario "' . $owner->first_name . ' ' . $owner->middle_name . ' ' . $owner->last_name . '".')->autoclose(8000);
            return redirect()->route('owners.index');
        }
    }

    public function edit($id){
        $owner = Owner::find($id);
        return view('layouts.owners.edit')->with(compact('owner'));
    }

    public function update(Request $request){
        $messages = [
            'owner_id.required' => 'El id del propietario es obligatorio',
            'owner_id.numeric' => 'El id del propietario debe ser un valor numérico',
            'owner_id.exists' => 'El id del propietario debe ser un valor numérico',
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
            'city.required' => 'La ciudad es obligatoria',
            'city.string' => 'La ciudad debe ser una cadena de texto'
        ];

        $rules = [
            'owner_id' => 'required|numeric|exists:owners,id',
            'first_name' => 'required|string|min:3|max:10',
            'middle_name' => 'required|string|min:3|max:10',
            'last_name' => 'required|string|min:3|max:30',
            'address' => 'required|string|max:30',
            'document_number' => 'required|min:7',
            'phone_number' => 'required|min:7|max:15',
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
            $existing_document = Owner::where([
                ['document_number', '=',$request->document_number],
                ['id', '!=', $request->owner_id]
            ])->get();
            if(count($existing_document) > 0){
                alert()->error('Ya existe otro propietario con el número de documento "' . $request->document_number . '".')->autoclose(8000);
            }
            $owner = Owner::find($request->owner_id);
            $data = [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'document_number' => $request->document_number,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'city' => $request->city,
            ];
            $owner->fill($data);
            $owner->save();
            alert()->success('Se ha editado correctamente al propietario "' . $owner->first_name . ' ' . $owner->middle_name . ' ' . $owner->last_name . '".')->autoclose(8000);
            return redirect()->route('owners.index');
        }
    }

    public function destroy($id){
        $owner = Owner::where('id', $id)->with(['vehicle'])->first();
        if($owner->vehicle == null){
            $owner->delete();
            alert()->success('Se ha eliminado el propietario "' . $owner->first_name . ' ' . $owner->middle_name . ' ' . $owner->last_name . '".')->autoclose(8000);
            return redirect()->route('owner.index');
        } else {
            alert()->error('Este propietario tiene un vehículo asociado, y no es posible eliminarlo.')->autoclose(8000);
            return redirect()->route('owner.index');
        }
    }
}
