
            @if (session('success'))
            toastr.success("{{ session('success') }}", "Exito");
            @endif

            @if (session('danger'))
            toastr.error("{{ session('danger') }}", "Error");
            @endif

            @if (session('warning'))
            toastr.warning("{{ session('warning') }}", "Peligro");
            @endif

            @if ($errors->any())
            toastr.error("@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach", "Error");
            @endif
