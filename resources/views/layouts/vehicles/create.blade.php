@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Nuevo vehículo</h3>
        <form method="POST" action="{{ route('vehicles.store') }}">
            {{ @csrf_field() }}
            <div class="form-group">
                <label>Placa</label>
                <input type="text" name="plate" class="form-control" required="required" placeholder="Placa del vehículo" value="{{ old('plate') }}">
            </div>
            <div class="form-group">
                <label>Color</label>
                <input type="text" name="color" class="form-control" required="required" placeholder="Color del vehículo" value="{{ old('color') }}">
            </div>
            <div class="form-group">
                <label>Marca</label>
                <select name="brand_id" class="form-control">
                    <option>Seleccione...</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tipo</label>
                <select class="form-control" name="type">
                    <option>Seleccione...</option>
                    <option value="private">Particular</option>
                    <option value="public">Público</option>
                </select>
            </div>
            <div class="form-group">
                <label>Propietario</label>
                <select class="form-control" name="owner_id">
                    <option>Seleccione...</option>
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}">{{ $owner->first_name . ' ' . $owner->middle_name . ' ' . $owner->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Conductor</label>
                <select class="form-control" name="driver_id">
                    <option>Seleccione...</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name }}</option>
                    @endforeach
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
