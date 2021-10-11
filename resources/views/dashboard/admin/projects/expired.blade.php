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
					<th></th>
				</tr>
          	</thead>
          	<tbody>
			  	@foreach($projects as $project)
			  	<tr>
				  	<td>{{ $project->name }} <br>
						<small>({{ $project->customer ? $project->customer->name : '-' }})</small>
					</td>
					<td>{{$project->statusForHummans()  }}&nbsp;&nbsp;
						<a href="{{ route('admin.projects.editStatus', $project) }}" title="Cambiar Estado"><i class="fas fa-sync-alt"></i> </a>
					</td>
					<td>{{ $project->code }}</td>
					<td>{{ $project->commune ? $project->commune->label : '-' }}</td>
					<td>
						<strong>Ingresado</strong> : {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->entry_date)->format('d-m-Y') }} <br>
						<strong>Limite Re-Ingreso</strong> : {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->limit_re_entry_date)->format('d-m-Y') }} <br>
						<strong>Re-ingresado</strong>: {{ $project->re_entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->re_entry_date)->format('d-m-Y') : '-' }}
						&nbsp;&nbsp; <a href="{{ route('admin.projects.editReEntry', $project) }}" title="Re-Ingresar Proyecto"><i class="far fa-calendar-plus"></i> </a>

					</td>
					<td>
						<a href="{{ route('admin.projects.show', $project) }}" class="text-info" title="Ver Ficha del Proyecto">
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
						</a>&nbsp;&nbsp;

						<form id="delete-project-{{ $project->id }}" method="POST" action="{{ route('admin.projects.destroy', $project->id ) }}">
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