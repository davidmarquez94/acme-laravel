@extends('layouts.app')

@section('header_scripts')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <h3>Vehículos</h3>
        <hr />
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary">
            Crear vehículo
        </a>
        <br />
        <br />
        <div class="table-responsive">
            <table class="table table-hover" id="vehicles-table">
                <thead>
                    <th>Id</th>
                    <th>Placa</th>
                    <th>Color</th>
                    <th>Marca</th>
                    <th>Tipo</th>
                    <th>Propietario</th>
                    <th>Conductor</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->id }}</td>
                            <td>{{ $vehicle->plate }}</td>
                            <td>{{ $vehicle->color }}</td>
                            <td>{{ $vehicle->brand }}</td>
                            <td>{{ $vehicle->type }}</td>
                            <td>{{ $vehicle->owner->first_name . ' ' . $vehicle->owner->middle_name . ' ' . $vehicle->owner->last_name }}</td>
                            <td>{{ $vehicle->driver->first_name . ' ' . $vehicle->driver->middle_name . ' ' . $vehicle->driver->last_name }}</td>
                            <td>
                                <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <a href="#" class="btn btn-danger" onclick="return deleteVehicle('{{ route('vehicles.destroy', $vehicle->id) }}');">
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
<script src="{{ asset('plugins/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#vehicles-table').DataTable();
        });

        function deleteVehicle(path){
            swal({
                title: "¿Está seguro?",
                text: "Si usted elimina el vehículo, no podrá revertir la decisión después.",
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
