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
                            <label for="status">Estado *</label>
                            <select name="status" class="form-select mb-0 select2" id="status" aria-label="seleccione el estado" placeholder="Seleccione..." required>
                                <option value="">Seleccione...</option>
								<option value="registered" {{ $project->status == 'registered' ? 'selected="selected"':'' }}>Ingresado</option>
								<option value="in_evaluation" {{ $project->status == 'in_evaluation' ? 'selected="selected"':'' }}>En Evaluacion</option>
								<option value="re_entered" {{ $project->status == 're_entered' ? 'selected="selected"':'' }}>Re-Ingresado</option>
								<option value="accepted" {{ $project->status == 'accepted' ? 'selected="selected"':'' }}>Aceptado</option>
								<option value="rejected" {{ $project->status == 'rejected' ? 'selected="selected"':'' }}>Rechazado</option>
                                <option value="in_budget" {{ $project->status == 'in_budget' ? 'selected="selected"':'' }}>En Presupuesto</option>

                            </select>
                        </div>

                    </div>
                    <div class="row">
						<div class="col-md-4 mb-3">
							<label for="entry_date">Fecha Re-Ingreso *</label>
                            <div class="input-group">
								<span class="input-group-text">
									<svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
								</span>
								<input data-datepicker="" name="re_entry_date" class="form-control" id="re_entry_date" type="text" placeholder="dd-mm-yyyy"  value="{{ $project->re_entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->re_entry_date)->format('d-m-Y') : '' }}" required>
							</div>
                        </div>
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