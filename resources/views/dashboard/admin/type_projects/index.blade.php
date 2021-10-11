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
					<th>Descripcion</th>
					<th>Limite Días Re-Ingreso</th>
					<th>Proyectos Asociados</th>
					<th>Acciones</th>
				</tr>
          	</thead>
          	<tbody>
			  	@foreach($type_projects as $tp)
			  	<tr>
				  	<td>{{ $tp->name }}</td>
					<td>{{ $tp->description }}</td>
					<td>{{ $tp->re_entry_days_limit }}</td>
					<td>
						 @forelse($tp->projects as $project)
						 {{ $project->name }}
						 @empty
						 -
						 @endforelse
					</td>
					<td>
						<a href="{{ route('admin.type_projects.edit', $tp) }}" title="Editar Tipo de Proyecto">
							<i class="fas fa-edit"></i>
						</a>
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