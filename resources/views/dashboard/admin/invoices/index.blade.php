@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')

<div class="card">
	<div class="table-responsive py-4">
		<table class="table table-flush user-table table-hover align-items-center" id="datatable">
          	<thead class="thead-light">
				<tr>

					<th>Actualizado</th>
					<th>N° Factura</th>
					<th>Monto ($)</th>
					<th>Estado</th>
					<th>Fecha Aprobación</th>
                    <th>Doc.</th>
					<th></th>
				</tr>
          	</thead>
          	<tbody>
			  	@foreach($invoices as $invoice)
			  	<tr>
				  	<td>
						<small>
							{{ \Carbon\Carbon::parse($invoice->updated_at)->locale('es_ES')->isoFormat('D MMM YYYY H:m').' hrs.'}}
					  	</small>
					</td> 	
				  	<td>{{ $invoice->number }}</td>
					<td>{{ $invoice->amount }}</td>
					<td>
						@if($invoice->status)
                    	<span class="badge super-badge bg-{{ $invoice->statusLabels()['class'] }}">{{ $invoice->statusLabels()['label'] }}</span>&nbsp;&nbsp;
						<a href="{{ route('admin.projects.invoices.editStatus', [$project , $invoice]) }}" title="Cambiar Estado"><i class="fas fa-sync-alt"></i> </a>
						@else
						-
						@endif
					</td>
					<td>
					<small>
						@if($invoice->accepted_date)
						 {{ \Carbon\Carbon::createFromFormat('Y-m-d', $invoice->accepted_date)->locale('es_ES')->isoFormat('D MMM YYYY') }} </span>
						@else
							-
						@endif	
						</small>
					</td>
                    <td>
                        @if($invoice->doc_path)
                        <a href="{{ Storage::url($invoice->doc_path) }}" target="_blank">
                            <i class="fas fa-download"></i>
                        </a>
                        @else
                        -
                        @endif
                    </td>

					<td>
						<a href="{{ route('admin.projects.invoices.edit', [$project , $invoice]) }}" title="Editar Factura">
							<i class="fas fa-edit"></i>
						</a>&nbsp;&nbsp;
						<a 
							title="Eliminar Cliente"
							onclick="confirm('Estas seguro de eliminar la Factura?') ? document.getElementById('delete-invoice-{{ $invoice->id }}').submit() : ''" 
							class="text-danger ">
							<i class="fas fa-trash-alt"></i>
						</a>

						<form id="delete-invoice-{{ $invoice->id }}" method="POST" action="{{ route('admin.projects.invoices.destroy', [$project , $invoice] ) }}">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
						</form>
					</td>
				</tr>
				@endforeach
			<tbody>	
        </table>
      </div>
    </div>
</div>

@endsection
@section('scripts')
	@parent
@endsection