@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')

{{--  Form Errors--}}
@include('components.dashboard.form_errors')


<div class="row">
    <form action="{{ route('admin.budgets.update',$budget) }}" method="POST"  enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">      
    @csrf
    <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body shadow-sm mb-4">
                    <h6 class="mb-3">Información Presupuesto</h6><br>  
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="number">N. Presupuesto *</label>
                                <input name="number" class="form-control " id="number" type="text" placeholder="Ingrese N° Presupuesto" value="{{ $budget->number }}" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="amount">Monto($CLP)</label>
                                <input name="amount" class="form-control " id="amount" type="number" placeholder="Monto ($)" value="{{ $budget->amount }}">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="status">Estado</label>
                                <select name="status" class="form-select mb-0 select2" id="status" aria-label="seleccione el estado" placeholder="Seleccione...">
                                    <option value="" >Seleccione...</option>
                                    <option value="accepted" {{ $budget->status == 'accepted' ?  'selected="selected"' : ''}}>Aceptado</option>
                                    <option value="entered" {{ $budget->status == 'entered' ?  'selected="selected"' : ''}}>Ingresado</option>
                                    <option value="rejected" {{ $budget->status == 'rejected' ?  'selected="selected"' : ''}}>Rechazado</option>
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
								<input data-datepicker="" name="accepted_date" class="form-control" id="accepted_date" type="text" 
                                placeholder="dd-mm-yyyy" 
                                value="{{ $budget->accepted_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $budget->accepted_date)->format('d-m-Y') : '' }}"
                                >
							</div>
                        </div>
                        <div class="col-md-4 mb-3">
							<label for="entry_date">Fecha de Ingreso (GyS para Cliente) </label>
                            <div class="input-group">
								<span class="input-group-text">
									<svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
								</span>
								<input data-datepicker="" name="entry_date" class="form-control" id="entry_date" type="text"
                                placeholder="dd-mm-yyyy"
                                value="{{ $budget->entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $budget->entry_date)->format('d-m-Y') : '' }}"
                                >
							</div>
                        </div>
						<div class="col-md-4 mb-3">
							<label for="doc">Documento Asociado</label>
                            <input name="doc" class="form-control" id="doc" type="file" >
                            <small>Ingresar solo si se desea reemplazar!</small>
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
@endsection