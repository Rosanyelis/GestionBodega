@extends('layout.app')
@section('contenido')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid mt-0 pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl p-3">
            <div class="card card-flush mb-4">
                <div class="card-body">
                    <form class="row" action="{{ route('producto.store') }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-md-2">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control" placeholder="Ejm: img.jpg">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Codigo</label>
                            <input type="text" name="codigo" class="form-control" placeholder="Ejm: 98398574">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Producto</label>
                            <input type="text" name="producto" class="form-control"
                                placeholder="Ejm: Ejm: Lapiz Mongol">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Categoría</label>
                            <input type="text" name="categoria" class="form-control" placeholder="Ejm: Utiles">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Precio</label>
                            <input type="text" name="precio" class="form-control" placeholder="Ejm: 2300">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Descripción</label>
                            <input type="text" name="descripcion" class="form-control"
                                placeholder="Ejm: Caja de lápices">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mt-5">Guardar Producto</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-flush">
                <!--begin::Card body-->
                <div class="card-body ">
                    <!--begin::Table-->

                    <table id="kt_datatable_example_5"
                        class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                        <thead>
                            <tr class="fw-bolder fs-6 text-gray-800 px-4">
                                <th class="min-w-60px">#</th>
                                <th class="min-w-200px">Producto</th>
                                <th class="min-w-100px">Código</th>
                                <th class="min-w-100px">Categoría</th>
                                <th class="min-w-100px">Precio</th>
                                <th class="min-w-200px">Descripción</th>
                                <th class="text-end min-w-70px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin::Thumbnail-->
                                            <div class="symbol symbol-50px">
                                                <span class="symbol-label" style="background-image:url('{{ asset('/products/'.$item->foto.'') }}');"></span>
                                            </div>
                                            <!--end::Thumbnail-->
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <span
                                                    class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{ $item->producto }}</span>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->codigo }}</td>
                                    <td>{{ $item->categoria }}</td>
                                    <td>{{ $item->precio }}</td>
                                    <td>{{ $item->descripcion }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('producto.edit', $item->id) }}">
                                            <i class="fas fa-pen-square fs-1"></i>
                                            </button>&nbsp;&nbsp;
                                            <!--  -->
                                            <a href="javascript:void();" data-bs-toggle="modal"
                                                data-bs-target="#Delete-{{ $item->id }}">
                                                <i class="fas fa-trash text-danger fs-1"></i>
                                            </a>
                                            <div class="modal fade" tabindex="-1" id="Delete-{{ $item->id }}">
                                                <div class="modal-dialog">
                                                    <form method="POST"
                                                        action="{{ route('producto.destroy', $item->id) }}"
                                                        class="modal-content">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header p-3">
                                                            <h5 class="modal-title"></h5>
                                                            <!--begin::Close-->
                                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                <i class="fas fa-times"></i>
                                                            </div>
                                                            <!--end::Close-->
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <i
                                                                class="fas fa-exclamation-triangle text-warning fs-5x"></i>
                                                            <h3 class="mt-5">¿Está Seguro de Eliminar el Registro?</h3>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-danger">Si, Estoy
                                                                Seguro</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Category-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
<div>
    @endsection
    @section('scripts')
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script>
        "use strict";
        $("#kt_datatable_example_5").DataTable({
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "_MENU_",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
                // "lengthMenu": " _MENU_",
            },
            "dom": "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });

    </script>
    <!--end::Page Vendors Javascript-->
    @endsection
