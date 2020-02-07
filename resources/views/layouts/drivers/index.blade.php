@extends('layouts.app')

@section('header_scripts')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <h3>Conductores</h3>
        <hr />
        <a href="{{ route('drivers.create') }}" class="btn btn-primary">
            Crear conductor
        </a>
        <br />
        <br />
        <div class="table-responsive">
            <table class="table table-hover" id="drivers-table">
                <thead>
                    <th>Id</th>
                    <th>Primer Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Apellidos</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Tipo de licencia</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach($drivers as $driver)
                        <tr>
                            <td>{{ $driver->id }}</td>
                            <td>{{ $driver->first_name }}</td>
                            <td>{{ $driver->middle_name }}</td>
                            <td>{{ $driver->last_name }}</td>
                            <td>{{ $driver->address }}</td>
                            <td>{{ $driver->phone_number }}</td>
                            <td>{{ $driver->license_type }}</td>
                            <td>{{ $driver->city }}</td>
                            <td>
                                <a href="#" class="btn btn-primary">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <a href="#" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer_scripts')
<script src="{{ asset('plugins/DataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#drivers-table').DataTable();
        });
    </script>
@endsection
