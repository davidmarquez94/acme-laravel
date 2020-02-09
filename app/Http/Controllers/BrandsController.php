<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SweetAlert;
use App\Brand;

class BrandsController extends Controller
{
    //Listar marcas
    public function index(){
        //Busca marcas
        $brands = Brand::all();
        return view('layouts.brands.index')->with(compact('brands'));//Devuelve a la vista con la variable
    }

    //Nueva marca
    public function create(){
        return view('layouts.brands.create');//Devuelve a la vista de creación de marca
    }

    //Guardar marca
    public function store(Request $request){
        $messages = [
            'name.required' => 'El nombre de la marca es obligatorio',
            'name.string' => 'El nombre de la marca debe ser una cadena de texto',
            'name.unique' => 'La marca ya está registrada en le base de datos'
        ];//Mensajes de error para las validaciones

        $rules = [
            'name' => 'required|string|unique:brands'
        ];//Reglas de validación

        $validator = Validator::make($request->all(), $rules, $messages);//Ejecuta validador

        if($validator->fails()){//Fallo del validador
            $errors = "";
            foreach($validator->errors()->messages() as $message){
                foreach($message as $error){
                    $errors .= "" . $error . "  //  ";
                }
            }
            alert()->error($errors)->autoclose(8000);
            return back()->withInput();//Regresa al formulario con alerta de error. Coloca de nuevo los valores ingresados
        } else {
            $data = [
                'name' => $request->name,
            ];//Datos a insertar
            $brand = new Brand($data);//Instancia modelo
            $brand->save();//Guarda registro

            alert()->success('La marca "' . $brand->name . '" ha sido creada exitosamente');
            return redirect()->route('brands.index');//Devuelve al listado de marcas con mensaje de éxito
        }
    }

    //Editar marca
    public function edit($id){
        $brand = Brand::find($id);//Encuentra marca por id
        return view('layouts.brands.edit')->with(compact('brands'));//Regresa a formulario de edición
    }

    //Actualizar marca
    public function update(Request $request){
        $messages = [
            'brand_id.required' => 'El id de la marca es obligatorio',
            'brand_id.numeric' => 'El id de la marca debe ser un valor numérico',
            'brand_id.exists' => 'El id de la marca no está registrado en la base de datos',
            'name.required' => 'El nombre de la marca es obligatorio',
            'name.string' => 'El nombre de la marca debe ser una cadena de texto'
        ];//Mensajes de validación

        $rules = [
            'brand_id' => 'required|numeric|exists:brands,id',
            'name' => 'required|string'
        ];//Reglas de validación

        $validator = Validator::make($request->all(), $rules, $messages);//Ejecuta validador

        if($validator->fails()){//Fallo de validador
            $errors = "";
            foreach($validator->errors()->messages() as $message){
                foreach($message as $error){
                    $errors .= "" . $error . "  //  ";
                }
            }
            alert()->error($errors)->autoclose(8000);
            return back()->withInput();//Regresa al formulario con mensajes de error en validación
        } else {
            $existing_brand = Brand::where([
                ['id', '!=', $request->brand_id],
                ['name', '=', $request->name]
            ])->get();//Busca marca con diferente id y mismo nombre
            if(count($existing_brand) > 0){
                alert()->error('Ya existe una marca con el nombre "' . $request->name . '".')->autoclose(8000);
                return back()->withInput();//Devuelve error si encuentra al menos 1
            } else {
                $brand = Brand::find($request->brand_id);//Encuentra marca por id
                $data = [
                    'name' => $request->name
                ];//Define datos de inserción
                $brand->fill($data);//Rellena modelo con datos nuevos
                $brand->save();//Guarda marca
                alert()->success('La marca "' . $brand->name . '" ha sido editada exitosamente')->autoclose(8000);
                return redirect()->route('brands.index');//Regresa al listado de marcas con mensaje de éxito
            }
        }
    }

    //Borrar marca
    public function destroy($id){
        $brand = Brand::where('id', $id)->with(['vehicles'])->first();//Encuentra marca por id
        if(count($brand->vehicles) > 0){//Si encuentra relaciones no permite borrar
            alert()->error('La marca "' . $brand->name . '" tiene vehículos asociados y no es posible eliminarla')->autoclose(8000);
            return redirect()->route('brands.index');
        } else {
            $brand->delete();//Borra marca
            return redirect()->route('brands.index');//Regresa al listado de marcas con mensaje de éxito
        }
    }
}
