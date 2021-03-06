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
                                <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger" onclick="return deleteDriver('{{ route('drivers.destroy', $driver->id) }}');">
                                    <i class="fa fa-trash"></i>
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
<script src="{{ asset('plugins/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#drivers-table').DataTable();
        });

        function deleteDriver(path){
            swal({
                title: "¿Está seguro?",
                text: "Si usted elimina al conductor, no podrá revertir la decisión después.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.replace(path);
                } else {
                    swal("Ha cancelado la decisión");
                }
            });
        }
    </script>
@endsection
