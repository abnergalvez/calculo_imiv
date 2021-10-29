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
					<th>Numero <br> Presupuesto</th>
					<th>Estado</th>
					<th>Código<br>Proyecto</th>
					<th>Fechas</th>
					<th>Limite <br> Ingreso</th>
					<th></th>
				</tr>
          	</thead>
          	<tbody>
			  	@foreach($budgets as $budget)
			  	<tr>
					<td>{{ \Carbon\Carbon::parse($budget->updated_at)->locale('es_ES')->isoFormat('D MMM YYYY')}}</td>
				  	<td>{{ $budget->number }} 
						@if($budget->doc_path)  
					  	
					 	 <a href="{{ Storage::url($budget->doc_path) }}" target="_blank" title="Descargar Documento">
						  	<i class="fas fa-file-download"></i>
						</a>
						@endif
					</td>
					  <td>
						@if($budget->status)
                    	<span class="badge super-badge bg-{{ $budget->statusLabels()['class'] }}">{{ $budget->statusLabels()['label'] }}</span>&nbsp;&nbsp;
						@else
						-
						@endif
						<a href="{{ route('admin.budgets.editStatus', $budget->id) }}" title="Cambiar Estado"><i class="fas fa-sync-alt"></i> </a>

					</td>
					<td>
						@if($budget->project)
						<a href="{{ route('admin.projects.show', $budget->project->id )}}">{{ $budget->project->code }}</a>
						@else
						-
						@endif
					</td>
				  	<td>

						@if($budget->accepted_date)
							@if( $budget->status == "accepted" || $budget->status == "entered" )
							<i class="far fa-calendar-check text-success"></i>
							@endif	
							<strong class="badge bg-primary">Aceptación</strong> : <span class="badge bg-light text-dark"> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $budget->accepted_date)->locale('es_ES')->isoFormat('D MMM YYYY') }} </span><br>
							@if($budget->entry_date)
								@if( $budget->status == "entered" )
								<i class="far fa-calendar-check text-success"></i>
								@endif	
								<strong class="badge bg-primary">Ingreso</strong> : <span class="badge bg-light text-dark"> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $budget->entry_date)->locale('es_ES')->isoFormat('D MMM YYYY') }} </span><br> 
							@endif
						@else
							-
						@endif
					</td> 	
				  	
					<td>


					@if($budget->accepted_date)		
						<small>
							{{ \Carbon\Carbon::parse($budget->entry_date)->locale('es_ES')->isoFormat('D MMM YYYY')}}
					  	</small>					
						<br>
						@if($budget->entry_date < \Carbon\Carbon::today() &&
								($budget->status == "accepted" || !$budget->status)
							)
							<strong class="badge bg-danger">Vencido <br> No Ingresado</strong><br>
						@endif

						@if($budget->entry_date && $budget->status == "entered")
							<strong class="badge bg-success">Ingresado</strong><br>
						@else
							@if($budget->entry_date >= \Carbon\Carbon::today()  && ( $budget->status == "accepted" || $budget->status == NULL))
							<strong class="badge bg-warning">por Ingresar</strong><br>
							@endif
						@endif
					@else
					 sin datos
					@endif
						
					</td> 

					<td>
						<a href="{{ route('admin.budgets.edit', $budget) }}" title="Editar Presupuesto">
							<i class="fas fa-edit"></i>
						</a>&nbsp;&nbsp;
						<a 
							title="Eliminar Presupuesto"
							onclick="confirm('Estas seguro de eliminar el presupuesto? esto no eliminara el proyecto') ? document.getElementById('delete-budget-{{ $budget->id }}').submit() : ''" 
							class="text-danger ">
							<i class="fas fa-trash-alt"></i>
						</a>

						<form id="delete-budget-{{ $budget->id }}" method="POST" action="{{ route('admin.budgets.destroy', $budget ) }}">
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