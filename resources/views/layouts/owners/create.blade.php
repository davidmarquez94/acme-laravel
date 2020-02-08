@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Nuevo propietario</h3>
        <form method="POST" action="{{ route('owners.store') }}">
            {{ @csrf_field() }}
            <div class="form-group">
                <label>Primer nombre</label>
                <input type="text" name="first_name" class="form-control" required="required" placeholder="Primer nombre del propietario" value="{{ old('first_name') }}">
            </div>
            <div class="form-group">
                <label>Segundo nombre</label>
                <input type="text" name="middle_name" class="form-control" required="required" placeholder="Segundo nombre del propietario" value="{{ old('middle_name') }}">
            </div>
            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" class="form-control" required="required" placeholder="Apellidos del propietario" value="{{ old('last_name') }}">
            </div>
            <div class="form-group">
                <label>Documento</label>
                <input type="text" name="document_number" class="form-control" required="required" placeholder="Número de cédula del propietario" value="{{ old('document_number') }}">
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="address" class="form-control" required="required" placeholder="Dirección de residencia del propietario" value="{{ old('address') }}">
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="phone_number" class="form-control" required="required" placeholder="Número de teléfono del propietario" value="{{ old('phone_number') }}">
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
