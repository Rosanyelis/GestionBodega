@extends('layout.app')
@section('contenido')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid mt-0 pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row gy-2 g-xl-8">
                <div class="col-xl-12">
                    <!--begin::Contacts-->
                    <div class="card card-flush h-lg-100" id="kt_contacts_main">
                        <!--begin::Card body-->
                        <div class="card-body pt-5">
                            <!--begin::Form-->
                            <div class="form fv-plugins-bootstrap5 fv-plugins-framework">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="fs-6 fw-bold form-label mt-3 ">
                                            <h2>Escanea tu producto</h2>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container text-center">
                                            <input type="text" class="form-control form-control-sm" name="name"
                                                id="codigo-barra" autofocus placeholder="codigo de barra de producto">
                                        </div>
                                    </div>
                                </div>

                                <div class="separator mb-6"></div>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <img id="imagen-producto" class="img-responsive" width="70%" src=""
                                            alt="productos">
                                    </div>
                                    <div class="col-md-8">

                                        <ul>
                                            <li>
                                                <h2><strong>Producto:</strong> <span id="nombre-producto" class="text-danger"></span></h2>
                                            </li>
                                            <li>
                                                <h2><strong>Precio:</strong> <span id="precio-producto" class="text-danger"></span></h2>
                                            </li>
                                            <li>
                                                <h2><strong>Categoría:</strong> <span id="categoria-producto" class="text-danger"></span>
                                                </h2>
                                            </li>
                                            <li>
                                                <h2><strong>Descripción:</strong> <span id="descripcion-producto" class="text-danger"></span>
                                                </h2>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Contacts-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->

@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Capturar el evento de cambio del input de código de barras
        var input = $("#codigo-barra");
        var imagen = $("#imagen-producto");
        var src = imagen.attr("src");
        if (src === "" || src === undefined) {
            console.log('no tengo');
            let url = '{{ asset('assets/wait.png') }}';
            imagen.attr("src", url);
        }


        $("#codigo-barra").change(function () {
            // Obtener el valor del código de barras
            var codigoBarra = $(this).val();
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Realizar la consulta AJAX a la base de datos
            $.ajax({
                type: "POST",
                url: '{{ url('/getproducto') }}',
                data: {
                    _token: token,
                    codigoBarra: codigoBarra,
                },
                success: function (respuesta) {
                    // Si la consulta fue exitosa
                    let res = JSON.parse(respuesta)
                    let url = '{{ asset('') }}';

                    console.log(res);
                    if (res) {
                        // Mostrar la información del producto
                        let urlimg = url + 'products/' + res.foto;
                        imagen.attr("src", urlimg);
                        $("#nombre-producto").text(res.producto);
                        $("#precio-producto").text(res.precio);
                        $("#categoria-producto").text(res.categoria);
                        $("#descripcion-producto").text(res.descripcion);
                        $("#codigo-barra").val('');
                        $("#codigo-barra").focus();
                    }
                },
                error: function (error) {
                    // Mostrar un mensaje de error
                    $("#mensaje-error").text(error.responseText);
                },
            });
        });
    });

</script>
@endsection
