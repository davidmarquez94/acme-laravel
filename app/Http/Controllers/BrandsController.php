<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SweetAlert;
use App\Brand;

class BrandsController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('layouts.brands.index')->with(compact('brands'));
    }

    public function create(){
        return view('layouts.brands.create');
    }

    public function store(Request $request){
        $messages = [
            'name.required' => 'El nombre de la marca es obligatorio',
            'name.string' => 'El nombre de la marca debe ser una cadena de texto',
            'name.unique' => 'La marca ya está registrada en le base de datos'
        ];

        $rules = [
            'name' => 'required|string|unique:brands'
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
                'name' => $request->name,
            ];
            $brand = new Brand($data);
            $brand->save();

            alert()->success('La marca "' . $brand->name . '" ha sido creada exitosamente');
            return redirect()->route('brands.index');
        }
    }

    public function edit($id){
        $brand = Brand::find($id);
        return view('layouts.brands.edit')->with(compact('brands'));
    }

    public function update(Request $request){
        $messages = [
            'brand_id.required' => 'El id de la marca es obligatorio',
            'brand_id.numeric' => 'El id de la marca debe ser un valor numérico',
            'brand_id.exists' => 'El id de la marca no está registrado en la base de datos',
            'name.required' => 'El nombre de la marca es obligatorio',
            'name.string' => 'El nombre de la marca debe ser una cadena de texto'
        ];

        $rules = [
            'brand_id' => 'required|numeric|exists:brands,id',
            'name' => 'required|string'
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
            $existing_brand = Brand::where([
                ['id', '!=', $request->brand_id],
                ['name', '=', $request->name]
            ])->get();
            if(count($existing_brand) > 0){
                alert()->error('Ya existe una marca con el nombre "' . $request->name . '".')->autoclose(8000);
                return back()->withInput();
            } else {
                $brand = Brand::find($request->brand_id);
                $data = [
                    'name' => $request->name
                ];
                $brand->fill($data);
                $brand->save();
                alert()->success('La marca "' . $brand->name . '" ha sido editada exitosamente')->autoclose(8000);
                return redirect()->route('brands.index');
            }
        }
    }

    public function destroy($id){
        $brand = Brand::where('id', $id)->with(['vehicles'])->first();
        if(count($brand->vehicles) > 0){
            alert()->error('La marca "' . $brand->name . '" tiene vehículos asociados y no es posible eliminarla')->autoclose(8000);
            return redirect()->route('brands.index');
        } else {
            $brand->delete();
            return redirect()->route('brands.index');
        }
    }
}
