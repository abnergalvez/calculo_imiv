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
					<th>RUT</th>
					<th>Proyectos</th>
					<th>Acciones</th>
				</tr>
          	</thead>
          	<tbody>
			  	@foreach($customers as $customer)
			  	<tr>
				  	<td>
						{{ $customer->name }}
					</td>
					
					<td>{{ $customer->rut }}</td>
					<td>
						 @forelse($customer->projects as $project)
						 {{ $project->name }}
						 @empty
						 -
						 @endforelse
					</td>
					<td>
						<a href="{{ route('admin.customers.edit', $customer) }}" title="Editar CLiente">
							<i class="fas fa-edit"></i>
						</a>
						<a 
							title="Eliminar Cliente"
							onclick="confirm('Estas seguro de eliminar al Cliente?') ? document.getElementById('delete-customer-{{ $customer->id }}').submit() : ''" 
							class="text-danger ">
							<i class="fas fa-trash-alt"></i>
						</a>

						<form id="delete-customer-{{ $customer->id }}" method="POST" action="{{ route('admin.customers.destroy', $customer ) }}">
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