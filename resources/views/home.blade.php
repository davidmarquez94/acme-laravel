@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    Pruebas de conocimiento PHP Grupo OET<br />
                    <b>David Felipe Márquez González</b><br />
                    <b>Teléfono: </b>321 794 9964<br /><br />

                    <a class="btn btn-primary" href="{{ route('drivers.index') }}">
                        Conductores
                    </a>
                    <a class="btn btn-primary" href="{{ route('owners.index') }}">
                        Propietarios
                    </a>
                    <a class="btn btn-primary" href="{{ route('brands.index') }}">
                        Marcas
                    </a>
                    <a class="btn btn-primary" href="{{ route('vehicles.index') }}">
                        Vehículos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
