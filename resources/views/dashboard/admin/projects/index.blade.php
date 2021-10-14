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
					<th>Nombre</th>
					<th>Estado</th>
					<th>Codigo</th>
					<th>Comuna</th>
					<th>Fechas</th>
					<th>Limite <br> Re-Ingreso</th>
					<th></th>
				</tr>
          	</thead>
          	<tbody>
			  	@forelse($projects as $project)
			  	<tr>
				  	<td>{{ $project->name }} <br>
						<small>({{ $project->customer ? $project->customer->name : '-' }})</small>
					</td>
					<td>
						<span class="badge super-badge bg-{{ $project->statusClassBadge() }}">{{ $project->statusForHummans() }}</span>&nbsp;&nbsp;
						<a href="{{ route('admin.projects.editStatus', $project) }}" title="Cambiar Estado"><i class="fas fa-sync-alt"></i> </a>
					</td>
					<td>{{ $project->code }}</td>
					<td>{{ $project->commune ? $project->commune->label : '-' }}</td>
					<td>
						<strong class="badge bg-success">Ingresado</strong> : <span class="badge bg-light text-dark"> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->entry_date)->locale('es_ES')->isoFormat('D MMM YYYY') }} </span> <br>
						<strong class="badge bg-danger">Limite Re-Ingreso</strong> : <span class="badge bg-light text-dark"> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->limit_re_entry_date)->locale('es_ES')->isoFormat('D MMM YYYY') }} </span><br>
						<strong class="badge bg-success">Re-ingresado</strong> : <span class="badge bg-light text-dark"> {{ $project->re_entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->re_entry_date)->locale('es_ES')->isoFormat('D MMM YYYY') : '-' }} </span>
						&nbsp;&nbsp; <a href="{{ route('admin.projects.editReEntry', $project) }}" title="Re-Ingresar Proyecto"><i class="far fa-calendar-plus"></i> </a>

					</td>
					<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->limit_re_entry_date)->locale('es_ES')->isoFormat('D MMM YYYY') }}
					<br>	
					
						@if($project->re_entry_date)
							<strong class="badge bg-success">Re-Ingresado</strong><br>
								@if($project->re_entry_date > $project->limit_re_entry_date )
									<strong class="badge bg-primary">Fuera de fecha</strong>
								@endif

						@else
								@if($project->limit_re_entry_date >= $now )
									<strong class="badge bg-warning">por Ingresar</strong>
								@else
									<strong class="badge bg-danger">Vencido - No Re-Ingresado</strong>
								@endif
						
						@endif
					</td>
					<td>
						<a href="{{ route('admin.projects.show', $project) }}" class="" title="Ver Ficha del Proyecto">
							<i class="fas fa-eye"></i>
						</a>&nbsp;&nbsp;
						<a href="{{ route('admin.projects.edit', $project) }}" title="Editar Proyecto">
							<i class="fas fa-edit"></i>
						</a>&nbsp;&nbsp;
						<a 
							title="Eliminar Proyecto"
							onclick="confirm('Estas seguro de eliminar el proyecto?') ? document.getElementById('delete-project-{{ $project->id }}').submit() : ''" 
							class="text-danger ">
							<i class="fas fa-trash-alt"></i>
						</a>

						<form id="delete-project-{{ $project->id }}" method="POST" action="{{ route('admin.projects.destroy', $project->id ) }}">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
						</form>
					</td>
				</tr>
				@empty
				@endforelse

			<tbody>	
        </table>
      </div>
    </div>
</div>


@endsection
@section('scripts')
	@parent
@endsection