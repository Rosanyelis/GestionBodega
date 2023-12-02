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
                    <form class="row" action="{{ route('producto.importar') }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-md-8">
                            <label class="form-label">Cargue el Excel de productos</label>
                            <input type="file" name="file" class="form-control">
                            <span>El formato para la carga de productos puede descargarlo haciendo click en el siguiente enlace:</span>
                            <a href="{{ asset('formato-productos-a-importar.xlsx') }}" download="formato-de-importacion-de-producto.xlsx" >Descargar formato</a>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mt-5">Importar Producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->

    @endsection
