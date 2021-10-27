@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')

{{--  Form Errors--}}
@include('components.dashboard.form_errors')

<div class="row">
    <form action="{{ route('admin.projects.updateStatus', $project) }}" method="POST"  enctype="multipart/form-data">
		<input type="hidden" name="_method" value="put">
        @csrf
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body shadow-sm mb-4">

					<div class="row">
						<div class="col-md-6 mb-3">
                            <label for="status">Estado</label>
                            <select name="status" class="form-select mb-0 select2" id="status" aria-label="seleccione el estado" placeholder="Seleccione...">
                                <option value="">Seleccione...</option>
								<option value="registered_for_observation" {{ $project->status == 'registered_for_observation' ? 'selected="selected"':'' }}>Ingresado para Observación</option>
								<option value="in_correction" {{ $project->status == 'in_correction' ? 'selected="selected"':'' }}>En Corrección</option>
								<option value="re_entered" {{ $project->status == 're_entered' ? 'selected="selected"':'' }}>Re-Ingresado</option>
								<option value="accepted" {{ $project->status == 'accepted' ? 'selected="selected"':'' }}>Aceptado</option>
								<option value="rejected" {{ $project->status == 'rejected' ? 'selected="selected"':'' }}>Rechazado</option>
                                <option value="in_budget" {{ $project->status == 'in_budget' ? 'selected="selected"':'' }}>En Presupuesto</option>

                            </select>
                        </div>
                        <div class="col-md-6 mb-3" id="dateStatus">
							<label for="status_date"> Fecha <span id="dateName"></span> </label>
                            <div class="input-group">
								<span class="input-group-text">
                                    <i class="fas fa-calendar-check icon icon-xs" fill="currentColor"></i>
								</span>
								<input data-datepicker="" 
                                    name="status_date" 
                                    class="form-control" 
                                    id="status_date" 
                                    value="" 
                                >
							</div>
                            <small class="text-dark mb-0 text-wrap fw-lighter" style="font-size:.8125rem">Ingresar si se desea cambiar la fecha</small>
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

            $('#status').change( function() {
                
                $.ajax({
                    type: "POST",
                    url: '/api/dateNamesFromStatus',
                    data: {"status": $('#status :selected').val() },
                    success: function(resp){
                        if(resp != ''){
                            $('#dateName').html(resp);
                            $('#dateStatus').css('display','block');
                        }else{
                            $('#dateName').html('');
                            $('#dateStatus').css('display','none');

                        }
                    }
                });

            });
        });

        

    </script>
@endsection