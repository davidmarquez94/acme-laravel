@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Nuevo vehículo</h3>
        <form method="POST" action="{{ route('vehicles.update') }}">
            {{ @csrf_field() }}
            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
            <div class="form-group">
                <label>Placa</label>
                <input type="text" name="plate" class="form-control" required="required" placeholder="Placa del vehículo" value="{{ $vehicle->plate }}">
            </div>
            <div class="form-group">
                <label>Color</label>
                <input type="text" name="color" class="form-control" required="required" placeholder="Color del vehículo" value="{{ $vehicle->color }}">
            </div>
            <div class="form-group">
                <label>Marca</label>
                <select name="brand_id" class="form-control">
                    <option>Seleccione...</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @if($vehicle->brand_id == $brand->id) selected="selected">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tipo</label>
                <select class="form-control" name="type">
                    <option>Seleccione...</option>
                    <option value="private" @if($vehicle->type == 'private') selected="selected" @endif>Particular</option>
                    <option value="public" @if($vehicle->type == 'public') selected="selected" @endif>Público</option>
                </select>
            </div>
            <div class="form-group">
                <label>Propietario</label>
                <select class="form-control" name="owner_id">
                    <option>Seleccione...</option>
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}" @if($owner->id == $vehicle->owner_id) selected="selected" @endif>{{ $owner->first_name . ' ' . $owner->middle_name . ' ' . $owner->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Conductor</label>
                <select class="form-control" name="driver_id">
                    <option>Seleccione...</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" @if($driver->id == $vehicle->driver_id) selected="selected" @endif>{{ $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name }}</option>
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
