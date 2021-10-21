@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')

{{--  Form Errors--}}
@include('components.dashboard.form_errors')

<div class="row">
    <form action="{{ route('admin.revisers.update', $reviser ) }}" method="POST"  enctype="multipart/form-data">
    	<input type="hidden" name="_method" value="put">    
		@csrf
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body shadow-sm mb-4">
                    <h2 class="h5 mb-4">Información General</h2>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="first_name">Nombre *</label>
                                <input name="name" class="form-control " id="first_name" type="text" placeholder="Ingrese nombre" value="{{ $reviser->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="description">Descripción</label>
                                <input name="description" class="form-control " id="description" type="text" placeholder="" value="{{ $reviser->description }}" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="contact">Contacto</label>
                                <input name="contact" class="form-control" id="contact" type="text" placeholder="" value="{{ $reviser->contact }}" required>
                            </div>
							<small>Ingrese nombre de persona de contacto</small>
                        </div>
                    </div>
                    <div class="mt-0">
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
@endsection