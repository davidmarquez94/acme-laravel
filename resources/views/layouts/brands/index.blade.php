@extends('layouts.app')

@section('header_scripts')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <h3>Marcas</h3>
        <hr />
        <a href="{{ route('brands.create') }}" class="btn btn-primary">
            Crear marca
        </a>
        <br />
        <br />
        <div class="table-responsive">
            <table class="table table-hover" id="brands-table">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>
                                <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger" onclick="return deleteBrand('{{ route('brands.destroy', $brand->id) }}');">
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
            $('#brands-table').DataTable();
        });

        function deleteBrand(path){
            swal({
                title: "¿Está seguro?",
                text: "Si usted elimina la marca, no podrá revertir la decisión después.",
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
