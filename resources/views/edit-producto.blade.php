@extends('layout.app')
@section('contenido')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid mt-0 pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="card card-flush mb-4">
                <div class="card-body">
                    <h4>Editar Producto</h4>
                    <form class="row g-4" action="{{ route('producto.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Foto</label>
                            <input type="file" name="foto" class="form-control" >
                            @if ($errors->has('foto'))
                                <span class="text-danger">
                                    {{ $errors->first('foto') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Preview de Imagen de Producto</label><br>
                            <img src="{{ asset('/products/'.$data->foto.'') }}" alt="{{ $data->producto }}" class="w-100px">
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Codigo</label>
                            <input type="text" name="codigo" class="form-control" value="{{ $data->codigo }}">
                            @if ($errors->has('codigo'))
                                <span class="text-danger">
                                    {{ $errors->first('codigo') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Producto</label>
                            <input type="text" name="producto" class="form-control" value="{{ $data->producto }}">
                            @if ($errors->has('codigo'))
                                <span class="text-danger">
                                    {{ $errors->first('codigo') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Categoría</label>
                            <input type="text" name="categoria" class="form-control" value="{{ $data->categoria }}">
                            @if ($errors->has('categoria'))
                                <span class="text-danger">
                                    {{ $errors->first('categoria') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Precio</label>
                            <input type="text" name="precio" class="form-control" value="{{ $data->precio }}">
                            @if ($errors->has('precio'))
                                <span class="text-danger">
                                    {{ $errors->first('precio') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Descripción</label>
                            <input type="text" name="descripcion" class="form-control" value="{{ $data->descripcion }}">
                            @if ($errors->has('descripcion'))
                                <span class="text-danger">
                                    {{ $errors->first('descripcion') }}
                                </span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">Cancelar</button>
                            <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary">
                                <span class="indicator-label">Actualizar</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </form>
                </div>
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
