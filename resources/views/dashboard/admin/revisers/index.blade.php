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
					<th>Contacto</th>
					<th>Acciones</th>
				</tr>
          	</thead>
          	<tbody>
			  	@foreach($revisers as $reviser)
			  	<tr>
				  	<td>
						{{ $reviser->name }}
					</td>
					<td>
						{{ $reviser->description }}
					</td>
					
					<td>{{ $reviser->contact }}</td>

					<td>
						<a href="{{ route('admin.revisers.edit', $reviser) }}" title="Editar Revisor">
							<i class="fas fa-edit"></i>
						</a>&nbsp;&nbsp;
						<a 
							title="Eliminar Revisor"
							onclick="confirm('Estas seguro de eliminar al Revisor?') ? document.getElementById('delete-reviser-{{ $reviser->id }}').submit() : ''" 
							class="text-danger ">
							<i class="fas fa-trash-alt"></i>
						</a>

						<form id="delete-reviser-{{ $reviser->id }}" method="POST" action="{{ route('admin.revisers.destroy', $reviser ) }}">
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