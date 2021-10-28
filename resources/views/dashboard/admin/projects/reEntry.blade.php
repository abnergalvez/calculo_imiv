@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')
{{--  Form Errors--}}
@include('components.dashboard.form_errors')

<div class="row">
    <form action="{{ route('admin.projects.updateReEntry', $project) }}" method="POST"  enctype="multipart/form-data">
		<input type="hidden" name="_method" value="put">
        @csrf
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body shadow-sm mb-4">

                    <div class="row">
						<div class="col-md-4 mb-3">
							<label for="entry_doc">Documentos Asociados Re - Ingreso(zip)</label>
                            <input name="entry_doc" class="form-control" id="entry_doc" type="file" >
							<small>El documento ingresado reemplazara al anterior</small>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">
                        <i class="fas fa-save"></i> Guardar</button>
                    </div>
                    <small class="mt-2">* Campos Obligatorios</small>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection
@section('scripts')
	@parent

    <script>
        $(document).ready(function() {
            $(".select2").select2({
                theme: "bootstrap-5",
            });
        });

    </script>
@endsection