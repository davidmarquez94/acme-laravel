@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Nuevo conductor</h3>
        <form method="POST" action="{{ route('brands.store') }}">
            {{ @csrf_field() }}
            <div class="form-group">
                <label>Primer nombre</label>
                <input type="text" name="name" class="form-control" required="required" placeholder="Primer nombre del conductor" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>
@endsection
