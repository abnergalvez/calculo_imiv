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
								<option value="registered_for_observation" {{ $project->status == 'registered_for_observation' ? 'selected="selected"':'' }}>Primer Ingreso</option>
								<option value="in_correction" {{ $project->status == 'in_correction' ? 'selected="selected"':'' }}>Observaciones</option>
								<option value="re_entered" {{ $project->status == 're_entered' ? 'selected="selected"':'' }}>Segundo Ingreso</option>
								<option value="accepted" {{ $project->status == 'accepted' ? 'selected="selected"':'' }}>Aprobación</option>
								<option value="rejected" {{ $project->status == 'rejected' ? 'selected="selected"':'' }}>Rechazo</option>
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
                        <div class="col-md-4 mb-3">
                            <label for="reviser_id">Entidad Revisora</label>
                            <select name="reviser_id" class="form-select mb-0 select2" id="reviser_id" aria-label="seleccione revisor" placeholder="Seleccione..." >
                                <option value="" >Seleccione...</option>    
                                @foreach ($revisers as $reviser )
								<option value="{{ $reviser->id }}" {{ $reviser->id == $project->reviser_id ? 'selected="selected"' :''}}>{{ $reviser->name }}</option>
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
							<label for="entry_doc">Documentos Ingreso (zip)</label>
                            <input name="entry_doc" class="form-control" id="entry_doc" type="file" >
							<small>El documento ingresado reemplazara al anterior!</small>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="entry_doc">Documentos Re-Ingreso(zip)</label>
                            <input name="re_entry_doc" class="form-control" id="re_entry_doc" type="file" >
                            <small>El documento ingresado reemplazara al anterior!</small>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <h5>Fechas del Proyecto</h5>

                        <div class="col-md-3 mb-3">
							<label for="entry_date"> Primer Ingreso </label>
                            <div class="input-group">
								<span class="input-group-text">
                                    <i class="fas fa-calendar-check icon icon-xs {{ $project->entry_date ? 'text-success' : ''}}" fill="currentColor"></i>
								</span>
								<input data-datepicker="" 
                                    name="entry_date" 
                                    class="form-control" 
                                    id="entry_date"  
                                    value="{{ $project->entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->entry_date)->format('d-m-Y') : '' }}" 
                                >
							</div>
                            <small class="text-dark mb-0 text-wrap fw-lighter" style="font-size:.8125rem">Envío a Entidad Revisora</small>
                        </div>

                        <div class="col-md-3 mb-3">
							<label for="observation_date">Observaciones (Revisor) </label>
                            <div class="input-group">
								<span class="input-group-text">
                                    <i class="fas fa-calendar-check icon icon-xs {{ $project->observation_date ? 'text-success' : ''}}" fill="currentColor"></i>
								</span>
								<input data-datepicker="" 
                                    name="observation_date" 
                                    class="form-control" 
                                    id="observation_date"  
                                    value="{{ $project->observation_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->observation_date)->format('d-m-Y') : '' }}" 
                                >
							</div>
                            <small class="text-dark mb-0 text-wrap fw-lighter" style="font-size:.8125rem">Observación de Entidad Revisora</small>
                        </div>
                        

                        <div class="col-md-3 mb-3">
							<label for="re_entry_date"> Segundo Ingreso (Corrección) </label>
                            <div class="input-group">
								<span class="input-group-text">
                                    <i class="fas fa-calendar-check icon icon-xs {{ $project->re_entry_date ? 'text-success' : ''}}" fill="currentColor"></i>
								</span>
								<input data-datepicker="" 
                                    name="re_entry_date" 
                                    class="form-control" 
                                    id="re_entry_date" 
                                    value="{{ $project->re_entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->re_entry_date)->format('d-m-Y') : '' }}" 
                                >
							</div>
                            <small class="text-dark mb-0 text-wrap fw-lighter" style="font-size:.8125rem">Re-ingreso/Envío para Entidad Revisora</small>
                        </div>
                        

                        <div class="col-md-3 mb-3">
							<label for="final_status_date">Aprobación / Rechazo (Revisor) </label>
                            <div class="input-group">
								<span class="input-group-text">
                                    <i class="fas fa-calendar-check icon icon-xs {{ $project->final_status_date ? 'text-success' : ''}}" fill="currentColor"></i>
								</span>
								<input data-datepicker="" 
                                    name="final_status_date" 
                                    class="form-control" 
                                    id="final_status_date" 
                                    value="{{ $project->final_status_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->final_status_date)->format('d-m-Y') : '' }}" 
                                >
							</div>
                            <small class="text-dark mb-0 text-wrap fw-lighter" style="font-size:.8125rem">Respuesta Final Entidad Revisora</small>
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