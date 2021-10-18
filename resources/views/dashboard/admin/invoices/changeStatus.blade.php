@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')

{{--  Form Errors--}}
@include('components.dashboard.form_errors')

<div class="row">
    <form action="{{ route('admin.projects.invoices.updateStatus', [$project, $invoice] ) }}" method="POST"  enctype="multipart/form-data">
		<input type="hidden" name="_method" value="put">
        @csrf
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body shadow-sm mb-4">

					<div class="row">
						<div class="col-md-4 mb-3">
                            <label for="status">Estado</label>
                            <select name="status" class="form-select mb-0 select2" id="status" aria-label="seleccione el estado" placeholder="Seleccione...">
                                <option value="">Seleccione...</option>
								<option value="paid" {{ $invoice->status == 'paid' ? 'selected="selected"':'' }}>Pagado</option>
								<option value="to_pay" {{ $invoice->status == 'to_pay' ? 'selected="selected"':'' }}>Por Pagar</option>
								<option value="accepted" {{ $invoice->status == 'accepted' ? 'selected="selected"':'' }}>Aceptado</option>
								<option value="rejected" {{ $invoice->status == 'rejected' ? 'selected="selected"':'' }}>Rechazado</option>
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
        });

    </script>
@endsection