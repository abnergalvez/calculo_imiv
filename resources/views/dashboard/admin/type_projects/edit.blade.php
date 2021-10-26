@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')

{{--  Form Errors--}}
@include('components.dashboard.form_errors')

<div class="row">
    <form action="{{ route('admin.type_projects.update', $type_project) }}" method="POST"  enctype="multipart/form-data">
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
                                <input name="name" class="form-control " id="first_name" type="text" placeholder="Ingrese nombre completo" value="{{ $type_project->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <div class="form-group">
                                <label for="description">Descripción </label>
								<input type="text" class="form-control" name="description" id="description" value="{{ $type_project->description }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="budget_entry_days_limit">Límite días para Ingreso <br> Presupuesto *</label>
                                <input name="budget_entry_days_limit" class="form-control" id="budget_entry_days_limit" value="{{ $type_project->budget_entry_days_limit }}" type="number" min="1" step="1" required>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="observation_days_limit">Límite días para<br>  Obsevacion *</label>
                                <input name="observation_days_limit" class="form-control" id="observation_days_limit" value="{{ $type_project->observation_days_limit }}" type="number" min="1" step="1" required>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="re_entry_days_limit">Límite días para<br>  Re-Ingreso *</label>
                                <input name="re_entry_days_limit" class="form-control" id="re_entry_days_limit"  value="{{ $type_project->re_entry_days_limit }}" type="number" min="1" step="1" required>
                            </div>
                        </div>
						<div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="final_status_days_limit">Límite días para<br>  Estado Final *</label>
                                <input name="final_status_days_limit" class="form-control" id="final_status_days_limit" value="{{ $type_project->final_status_days_limit }}" type="number" min="1" step="1" required>
                            </div>
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