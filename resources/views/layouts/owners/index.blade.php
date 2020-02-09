@extends('layouts.app')

@section('header_scripts')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <h3>Propietarios</h3>
        <hr />
        <a href="{{ route('owners.create') }}" class="btn btn-primary">
            Crear propietario
        </a>
        <br />
        <br />
        <div class="table-responsive">
            <table class="table table-hover" id="owners-table">
                <thead>
                    <th>Id</th>
                    <th>Primer Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Apellidos</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach($owners as $owner)
                        <tr>
                            <td>{{ $owner->id }}</td>
                            <td>{{ $owner->first_name }}</td>
                            <td>{{ $owner->middle_name }}</td>
                            <td>{{ $owner->last_name }}</td>
                            <td>{{ $owner->address }}</td>
                            <td>{{ $owner->phone_number }}</td>
                            <td>{{ $owner->city }}</td>
                            <td>
                                <a href="{{ route('owners.edit', $owner->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger" onclick="return deleteOwner('{{ route('owners.destroy', $owner->id) }}');">
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
            $('#owners-table').DataTable();
        });

        function deleteOwner(path){
            swal({
                title: "¿Está seguro?",
                text: "Si usted elimina al propietario, no podrá revertir la decisión después.",
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
