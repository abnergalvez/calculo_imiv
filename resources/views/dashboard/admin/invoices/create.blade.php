@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')

{{--  Form Errors--}}
@include('components.dashboard.form_errors')

<div class="row">
    <form action="{{ route('admin.projects.invoices.store',$project->id ) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body shadow-sm mb-4">
                    <h2 class="h5 mb-4">Información General</h2>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="number">N° Factura *</label>
                                <input name="number" class="form-control " id="number" type="text" placeholder="Ingrese Numero Factura" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="amount">Monto ($) *</label>
                                <input name="amount" class="form-control " id="amount" type="text" placeholder="Ingrese Monto $" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="status">Estado *</label>
                                <select name="status" class="form-select mb-0 select2" id="status" aria-label="seleccione el estado" placeholder="Seleccione...">
                                    <option value="" >Seleccione...</option>
								    <option value="to_pay" selected>Por Pagar</option>
								    <option value="paid">Pagado</option>
								    <option value="acepted">Aceptado</option>
								    <option value="rejected">Rechazado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
							<label for="accepted_date">Fecha Aceptacion </label>
                            <div class="input-group">
								<span class="input-group-text">
									<svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
								</span>
								<input data-datepicker="" name="accepted_date" class="form-control" id="accepted_date" type="text" placeholder="dd-mm-yyyy">
							</div>
                        </div>

                        <div class="col-md-4 mb-3">
							<label for="doc">Documento</label>
                            <input name="doc" class="form-control" id="doc" type="file" >
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