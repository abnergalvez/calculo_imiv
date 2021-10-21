@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')

{{--  Form Errors--}}
@include('components.dashboard.form_errors')

<div class="row">
    <form action="{{ route('admin.budgets.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <input name="code_number" id="code_number" type="hidden" >

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body shadow-sm mb-4">
                
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="number">Elija Opcion de Creación *</label>
                            <select name="create_option" class="form-select mb-0 select2" id="create_option" aria-label="" required>
                                <option value="budget_project_create" >Crear Presupuesto y Crear Proyecto</option>
                                <option value="budget_create">Crear Presupuesto y Asignar a Proyecto Existente</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <h6 class="mb-3">Información Presupuesto</h6><br>  
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="number">N. Presupuesto *</label>
                                <input name="number" class="form-control " id="number" type="text" placeholder="Ingrese N° Presupuesto" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="amount">Monto($CLP)</label>
                                <input name="amount" class="form-control " id="amount" type="number" placeholder="Monto ($)" >
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="status">Estado</label>
                                <select name="status" class="form-select mb-0 select2" id="status" aria-label="seleccione el estado" placeholder="Seleccione...">
                                    <option value="" >Seleccione...</option>
                                    <option value="sent_customer">Enviado al Cliente</option>
                                    <option value="accepted">Aceptado</option>
                                    <option value="entered">Ingresado</option>
                                    <option value="rejected">Rechazado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
						<div class="col-md-4 mb-3">
							<label for="accepted_date">Fecha Aceptacion (Cliente) </label>
                            <div class="input-group">
								<span class="input-group-text">
									<svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
								</span>
								<input data-datepicker="" name="accepted_date" class="form-control" id="accepted_date" type="text" placeholder="dd-mm-yyyy" >
							</div>
                        </div>
                        <div class="col-md-4 mb-3">
							<label for="entry_date">Fecha de Ingreso (GyS para Cliente) </label>
                            <div class="input-group">
								<span class="input-group-text">
									<svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
								</span>
								<input data-datepicker="" name="entry_date" class="form-control" id="entry_date" type="text" placeholder="dd-mm-yyyy" >
							</div>
                        </div>
						<div class="col-md-4 mb-3">
							<label for="doc">Documento Asociado</label>
                            <input name="doc" class="form-control" id="doc" type="file" >
                        </div>
                    </div>

                    <hr>
                    <h6 class="mb-3">Información Proyecto</h6>
                    
                    <div class="row old-project" style="display: none">
                        <div class="col-md-8 mb-3">
                            <label for="project_id">Seleccione Proyecto *</label>
                            <select name="project_id" class="form-select mb-0 select2" id="project_id" aria-label="seleccione proyecto" placeholder="Seleccione..." required>
                                <option value="" >Seleccione...</option>    
                                @foreach ($projects as $project )
								<option value="{{ $project->id }}">{{ $project->name }}</option>
								@endforeach  
                            </select>
                        </div>
                    </div>

                    <div class="row new-project">
                        <div class="col-md-3 mb-3">
                            <div>
                                <label for="name">Nombre Proyecto *</label>
                                <input name="name" class="form-control " id="name" type="text" placeholder="Ingrese nombre proyecto" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="customer_id">Cliente *</label>
                            <select name="customer_id" class="form-select mb-0 select2" id="customer_id" aria-label="seleccione cliente" placeholder="Seleccione...">
                                <option value="" >Seleccione...</option>     
                                @foreach ($customers as $customer )
								<option value="{{ $customer->id }}">{{ $customer->name }}</option>
								@endforeach
                                
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group" title="Codigo Proyecto Generado Automaticamente">
                                <label for="code">Codigo *</label>
                                <input name="code" class="form-control" id="code" type="text" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="type_project_id">Tipo Proyecto *</label>
                            <select name="type_project_id" class="form-select mb-0 select2" id="type_project_id" aria-label="seleccione tipo proyecto" placeholder="Seleccione..." required>
                                <option value="" >Seleccione...</option>    
                                @foreach ($type_projects as $type_project )
								<option value="{{ $type_project->id }}">{{ $type_project->name }}</option>
								@endforeach
                                
                            </select>
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
                    url: '/api/projectCodeCreate',
                    data: {"customer_id": $('#customer_id :selected').val() },
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

            $('#create_option').change(function() {
                if($('#create_option :selected').val() == 'budget_project_create'){
                    $('.new-project').css('visibility','visible');
                    $('.old-project').css('display','none');
                    
                    $('#name').prop('required',true);
                    $('#customer_id').prop('required',true);
                    $('#type_project_id').prop('required',true);

                    $('#project_id').removeAttr('required');


                }

                if($('#create_option :selected').val() == 'budget_create'){
                    $('.new-project').css('visibility','hidden');
                    $('.old-project').css('display','block');

                    $('#project_id').prop('required',true);

                    $('#name').removeAttr('required');
                    $('#customer_id').removeAttr('required');
                    $('#type_project_id').removeAttr('required');
                }   
            });

            if($('#create_option :selected').val() == 'budget_project_create'){
                    $('.new-project').css('visibility','visible');
                    $('.old-project').css('display','none');
                    
                    $('#name').prop('required',true);
                    $('#customer_id').prop('required',true);
                    $('#type_project_id').prop('required',true);

                    $('#project_id').removeAttr('required');


                }

                if($('#create_option :selected').val() == 'budget_create'){
                    $('.new-project').css('visibility','hidden');
                    $('.old-project').css('display','block');

                    $('#project_id').prop('required',true);

                    $('#name').removeAttr('required');
                    $('#customer_id').removeAttr('required');
                    $('#type_project_id').removeAttr('required');
                } 
        });

        

    </script>
@endsection