@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')
{{--  Form Errors--}}
@include('components.dashboard.form_errors')

<div class="row">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST"  enctype="multipart/form-data">
		<input type="hidden" name="_method" value="put">
        @csrf
        <input name="code_number" id="code_number" type="hidden" value="{{ $project->code_number }}">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body shadow-sm mb-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="name">Nombre Proyecto *</label>
                                <input name="name" class="form-control " id="name" type="text" placeholder="Ingrese nombre proyecto" value="{{ $project->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="customer_id">Cliente</label>
                            <select name="customer_id" class="form-select mb-0 select2" id="customer_id" aria-label="seleccione cliente" placeholder="Seleccione...">
                                <option value="">Seleccione...</option>
                                @foreach ($customers as $customer )
								<option value="{{ $customer->id }}" {{ $customer->id == $project->customer_id ? 'selected="selected"' :''}}>{{ $customer->name }}</option>
								@endforeach
                                
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label for="code">Codigo</label>
                                <input name="code" class="form-control" id="code" type="text" value="{{ $project->code }}" readonly>
                            </div>
                        </div>

                    </div>

					<div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="entry_number">N° Ingreso</label>
                                <input name="entry_number" class="form-control" id="entry_number" type="text" value="{{ $project->entry_number }}" >
                            </div>
                        </div>
						<div class="col-md-9 mb-3">
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <input name="description" class="form-control" id="description" type="text" value="{{ $project->description }}">
                            </div>
                        </div>
					</div>

					<div class="row">
						<div class="col-md-4 mb-3">
                            <label for="status">Estado</label>
                            <select name="status" class="form-select mb-0 select2" id="status" aria-label="seleccione el estado" placeholder="Seleccione...">
                                <option value="">Seleccione...</option>
								<option value="registered" {{ $project->status == 'registered' ? 'selected="selected"':'' }}>Ingresado</option>
								<option value="in_evaluation" {{ $project->status == 'in_evaluation' ? 'selected="selected"':'' }}>En Evaluacion</option>
								<option value="re_entered" {{ $project->status == 're_entered' ? 'selected="selected"':'' }}>Re-Ingresado</option>
								<option value="accepted" {{ $project->status == 'accepted' ? 'selected="selected"':'' }}>Aceptado</option>
								<option value="rejected" {{ $project->status == 'rejected' ? 'selected="selected"':'' }}>Rechazado</option>
                                <option value="in_budget" {{ $project->status == 'in_budget' ? 'selected="selected"':'' }}>En Presupuesto</option>

                            </select>
                        </div>

						<div class="col-md-4 mb-3">
                            <label for="type_project_id">Tipo Proyecto *</label>
                            <select name="type_project_id" class="form-select mb-0 select2" id="type_project_id" aria-label="seleccione tipo proyecto" placeholder="Seleccione..." required>
                                <option value="">Seleccione...</option>
                                @foreach ($type_projects as $type_project )
								<option value="{{ $type_project->id }}" {{ $type_project->id == $project->type_project_id ? 'selected="selected"' :''}}>{{ $type_project->name }}</option>
								@endforeach
                                
                            </select>
                        </div>
                    </div>

                    <div class="row">
						<div class="col-md-8 mb-3">
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <input name="address" class="form-control" id="address" type="text"  value="{{ $project->address }}">
                            </div>
                        </div>
						<div class="col-md-4 mb-3">
                            <label for="commune_id">Comuna</label>
                            <select name="commune_id" class="form-select mb-0 select2" id="commune_id" placeholder="Seleccione...">
                                <option value="">Seleccione...</option>
                                @foreach ($communes as $commune )
								<option  value="{{ $commune->id }}" {{ $commune->id == $project->commune_id ? 'selected="selected"' : '' }}>{{ $commune->label }}</option>
								@endforeach
                                
                            </select>
                        </div>
                    </div>


                    <div class="row">
						<div class="col-md-4 mb-3">
							<label for="entry_date">Fecha Ingreso *</label>
                            <div class="input-group">
								<span class="input-group-text">
									<svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
								</span>
								<input data-datepicker="" name="entry_date" class="form-control" id="entry_date" type="text" placeholder="dd-mm-yyyy"  value="{{ $project->entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->entry_date)->format('d-m-Y') : '' }}" required>
							</div>
                        </div>
						<div class="col-md-4 mb-3">
							<label for="entry_doc">Documentos Asociados (zip)</label>
                            <input name="entry_doc" class="form-control" id="entry_doc" type="file" >
							<small>El documento ingresado reemplazara al anterior!</small>
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

            $('#customer_id').change( function() {
                
                $.ajax({
                    type: "POST",
                    url: '/api/projectCodeUpdate',
                    data: {
                        "customer_id": $('#customer_id :selected').val(),
                        "project_id": {{ $project->id }} 
                    },
                    success: function(resp){
                        if(resp['code'] != ''){
                            $('#code').val(resp['code']);
                            $('#code_number').val(resp['max_code_number']);
                        }else{
                            $('#code').val('');
                            $('#code_number').val(null);
                        }

                    }
                });

            });
        });

    </script>
@endsection