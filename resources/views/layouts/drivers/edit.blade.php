@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Editar conductor</h3>
        <form method="POST" action="{{ route('drivers.update') }}">
            {{ @csrf_field() }}
            <input type="hidden" name="driver_id" value="{{ $driver->id }}">
            <div class="form-group">
                <label>Primer nombre</label>
                <input type="text" name="first_name" class="form-control" required="required" placeholder="Primer nombre del conductor" value="{{ $driver->first_name }}">
            </div>
            <div class="form-group">
                <label>Segundo nombre</label>
                <input type="text" name="middle_name" class="form-control" required="required" placeholder="Segundo nombre del conductor" value="{{ $driver->middle_name }}">
            </div>
            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" class="form-control" required="required" placeholder="Apellidos del conductor" value="{{ $driver->last_name }}">
            </div>
            <div class="form-group">
                <label>Documento</label>
                <input type="text" name="document_number" class="form-control" required="required" placeholder="Número de cédula del conductor" value="{{ $driver->document_number }}">
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="address" class="form-control" required="required" placeholder="Dirección de residencia del conductor" value="{{ $driver->address }}">
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="phone_number" class="form-control" required="required" placeholder="Número de teléfono del conductor" value="{{ $driver->phone_number }}">
            </div>
            <div class="form-group">
                <label>Tipo de licencia</label>
                <select class="form-control" name="license_type">
                    <option>Seleccione...</option>
                    <option value="C1" @if($driver->license_type == 'c1') selected="selected" @endif>C1</option>
                    <option value="B1" @if($driver->license_type == 'b1') selected="selected" @endif>B1</option>
                </select>
            </div>
            <div class="form-group">
                <label>Ciudad</label>
                <select class="form-control" name="city">
                    <option>Seleccione...</option>
                    <option value="Bogota" @if($driver->city == 'Bogota') selected="selected" @endif>Bogotá</option>
                    <option value="Medellín" @if($driver->city == 'Medellín') selected="selected" @endif>Medellín</option>
                    <option value="Villavicencio" @if($driver->city == 'Villavicencio') selected="selected" @endif>Villavicencio</option>
                    <option value="Montería" @if($driver->city == 'Montería') selected="selected" @endif>Montería</option>
                    <option value="Barranquilla" @if($driver->city == 'Barranquilla') selected="selected" @endif>Barranquilla</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>
@endsection
