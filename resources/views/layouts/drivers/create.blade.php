@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Nuevo conductor</h3>
        <form method="POST" action="{{ route('drivers.store') }}">
            {{ @csrf_field() }}
            <div class="form-group">
                <label>Primer nombre</label>
                <input type="text" name="first_name" class="form-control" required="required" placeholder="Primer nombre del conductor">
            </div>
            <div class="form-group">
                <label>Segundo nombre</label>
                <input type="text" name="middle_name" class="form-control" required="required" placeholder="Segundo nombre del conductor">
            </div>
            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" class="form-control" required="required" placeholder="Apellidos del conductor">
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="address" class="form-control" required="required" placeholder="Dirección de residencia del conductor">
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="phone_number" class="form-control" required="required" placeholder="Número de teléfono del conductor">
            </div>
            <div class="form-group">
                <label>Tipo de licencia</label>
                <select class="form-control" name="license_type">
                    <option>Seleccione...</option>
                    <option value="c1">C1</option>
                    <option value="b1">B1</option>
                </select>
            </div>
            <div class="form-group">
                <label>Ciudad</label>
                <select class="form-control" name="license_type">
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
