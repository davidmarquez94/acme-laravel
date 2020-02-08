@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Editar propietario</h3>
        <form method="POST" action="{{ route('owners.update') }}">
            {{ @csrf_field() }}
            <input type="hidden" name="owner_id" value="{{ $owner->id }}">
            <div class="form-group">
                <label>Primer nombre</label>
                <input type="text" name="first_name" class="form-control" required="required" placeholder="Primer nombre del propietario" value="{{ $owner->first_name }}">
            </div>
            <div class="form-group">
                <label>Segundo nombre</label>
                <input type="text" name="middle_name" class="form-control" required="required" placeholder="Segundo nombre del propietario" value="{{ $owner->middle_name }}">
            </div>
            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" class="form-control" required="required" placeholder="Apellidos del propietario" value="{{ $owner->last_name }}">
            </div>
            <div class="form-group">
                <label>Documento</label>
                <input type="text" name="document_number" class="form-control" required="required" placeholder="Número de cédula del propietario" value="{{ $owner->document_number }}">
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="address" class="form-control" required="required" placeholder="Dirección de residencia del propietario" value="{{ $owner->address }}">
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="phone_number" class="form-control" required="required" placeholder="Número de teléfono del propietario" value="{{ $owner->phone_number }}">
            </div>
            <div class="form-group">
                <label>Ciudad</label>
                <select class="form-control" name="city">
                    <option>Seleccione...</option>
                    <option value="Bogota" @if($owner->city == 'Bogota') selected="selected" @endif>Bogotá</option>
                    <option value="Medellín" @if($owner->city == 'Medellín') selected="selected" @endif>Medellín</option>
                    <option value="Villavicencio" @if($owner->city == 'Villavicencio') selected="selected" @endif>Villavicencio</option>
                    <option value="Montería" @if($owner->city == 'Montería') selected="selected" @endif>Montería</option>
                    <option value="Barranquilla" @if($owner->city == 'Barranquilla') selected="selected" @endif>Barranquilla</option>
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
