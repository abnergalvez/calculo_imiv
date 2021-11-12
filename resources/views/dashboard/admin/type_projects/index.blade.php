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
					<th>Límite <br> Ingreso <br> Presupuesto</th>
					<th>Límite <br> Observación</th>
					<th>Límite <br> Re-Ingreso</th>
					<th>Límite <br> Estado Final</th>
					<th>Proyectos Asoc. (Código)</th>
					<th>Acciones</th>
				</tr>
          	</thead>
          	<tbody>
			  	@foreach($type_projects as $tp)
			  	<tr>
				  	<td>{{ $tp->name }}</td>
					<td>{{ $tp->budget_entry_days_limit ? $tp->budget_entry_days_limit.' días' : '-' }} </td>
					<td>{{ $tp->observation_days_limit ? $tp->observation_days_limit.' días' : '-' }} </td>
					<td>{{ $tp->re_entry_days_limit ? $tp->re_entry_days_limit.' días' : '-' }} </td>
					<td>{{ $tp->final_status_days_limit ? $tp->final_status_days_limit.' días' : '-' }}</td>
					<td>
						 @forelse($tp->projects as $project)
						 {{ $project->code }}
						 @empty
						 -
						 @endforelse
					</td>
					<td>
						<a href="{{ route('admin.type_projects.edit', $tp) }}" title="Editar Tipo de Proyecto">
							<i class="fas fa-edit"></i>
						</a>&nbsp;&nbsp;
						<a 
							title="Eliminar tipo Proyecto"
							onclick="confirm('Estas seguro de eliminar el Tipo de Proyecto, ?') ? document.getElementById('delete-tp-{{ $tp->id }}').submit() : ''" 
							class="text-danger ">
							<i class="fas fa-trash-alt"></i>
						</a>

						<form id="delete-tp-{{ $tp->id }}" method="POST" action="{{ route('admin.type_projects.destroy', $tp ) }}">
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