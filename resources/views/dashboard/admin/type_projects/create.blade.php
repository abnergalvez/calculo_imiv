@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')

{{--  Form Errors--}}
@include('components.dashboard.form_errors')

<div class="row">
    <form action="{{ route('admin.type_projects.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body shadow-sm mb-4">
                    <h2 class="h5 mb-4">Información General</h2>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="first_name">Nombre *</label>
                                <input name="name" class="form-control " id="first_name" type="text" placeholder="Ingrese nombre completo" required>
                            </div>
                        </div>
						<div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="re_entry_days_limit">Límite días para Re-Ingreso *</label>
                                <input name="re_entry_days_limit" class="form-control" id="re_entry_days_limit" type="number" min="1" step="1" required>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="description">Descripción </label>
								<input type="text" class="form-control" name="description" id="description" >
                            </div>
                        </div>
                    </div>
                    <div class="mt-0">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('scripts')
	@parent
@endsection