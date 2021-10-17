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
					<th>Rol</th>
					<th>Creado</th>
					<th>Acciones</th>
				</tr>
          	</thead>
          	<tbody>
			  	@foreach($users as $user)
			  	<tr>
				  	<td>
						<span>
							<a href="#" class="d-flex align-items-center">
								@if(!is_null($user->photo_path))
								<img alt="Image avatar" src="{{ Storage::url($user->photo_path) }}" class="avatar rounded-circle me-3">
								@else
								<img alt="Image avatar" src="/images/{{ $user->gender ? $user->gender : 'avatar' }}.png" class="avatar rounded-circle me-3">
								@endif  									
								<div class="d-block">
									<span class="fw-bold">{{ $user->name }}</span>
									<div class="small text-gray">{{ $user->email }}</div>
								</div>
							</a>
						</span>	  
					</td>
					
					<td>
						{{ $user->profileForHumans() }} <br>
						<small>({{ $user->super ? 'Super' : 'Normal' }})</small>
					</td>
					<td>{{ $user->created_at ? $user->created_at : ' - '}}</td>
					<td>
						<a href="{{ route('admin.users.edit', $user) }}" title="Editar Usuario">
							<i class="fas fa-user-edit"></i>
						</a>&nbsp;&nbsp;
						<a 
							title="Eliminar Usuario"
							onclick="confirm('Estas seguro de eliminar al usuario?') ? document.getElementById('delete-user-{{ $user->id }}').submit() : ''" 
							class="text-danger ">
							<span class="fas fa-user-times me-2"></span>
						</a>&nbsp;&nbsp;

						<form id="delete-user-{{ $user->id }}" method="POST" action="{{ route('admin.users.destroy', $user->id ) }}">
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