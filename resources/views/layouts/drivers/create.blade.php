@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Nuevo conductor</h3>
        <form method="POST" action="{{ route('drivers.store') }}">
            {{ @csrf_field() }}
            <div class="form-group">
                <label>Primer nombre</label>
                <input type="text" name="first_name" class="form-control" required="required" placeholder="Primer nombre del conductor" value="{{ old('first_name') }}">
            </div>
            <div class="form-group">
                <label>Segundo nombre</label>
                <input type="text" name="middle_name" class="form-control" required="required" placeholder="Segundo nombre del conductor" value="{{ old('middle_name') }}">
            </div>
            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" class="form-control" required="required" placeholder="Apellidos del conductor" value="{{ old('last_name') }}">
            </div>
            <div class="form-group">
                <label>Documento</label>
                <input type="text" name="document_number" class="form-control" required="required" placeholder="Número de cédula del conductor" value="{{ old('document_number') }}">
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="address" class="form-control" required="required" placeholder="Dirección de residencia del conductor" value="{{ old('address') }}">
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="phone_number" class="form-control" required="required" placeholder="Número de teléfono del conductor" value="{{ old('phone_number') }}">
            </div>
            <div class="form-group">
                <label>Tipo de licencia</label>
                <select class="form-control" name="license_type">
                    <option>Seleccione...</option>
                    <option value="C1">C1</option>
                    <option value="B1">B1</option>
                </select>
            </div>
            <div class="form-group">
                <label>Ciudad</label>
                <select class="form-control" name="city">
                    <option>Seleccione...</option>
                    <option value="Bogota">Bogotá</option>
                    <option value="Medellín">Medellín</option>
                    <option value="Villavicencio">Villavicencio</option>
                    <option value="Montería">Montería</option>
                    <option value="Barranquilla">Barranquilla</option>
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
