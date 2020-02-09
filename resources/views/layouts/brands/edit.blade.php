@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Editar conductor</h3>
        <form method="POST" action="{{ route('brands.update') }}">
            {{ @csrf_field() }}
            <input type="hidden" name="brand_id" value="{{ $brand->id }}">
            <div class="form-group">
                <label>Primer nombre</label>
                <input type="text" name="first_name" class="form-control" required="required" placeholder="Primer nombre del conductor" value="{{ $brand->first_name }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>
@endsection
