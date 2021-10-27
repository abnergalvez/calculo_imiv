@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@php

use Illuminate\Support\Str;

@endphp

@section('content_dashboard')
<div class="card">
	<div class="table-responsive py-4">
		<table class="table table-flush user-table table-hover align-items-center" id="datatable">
          	<thead class="thead-light">
				<tr>
					<th>Código</th>
					<th>Nombre</th>
					<th>Estado</th>
					
					<th>Comuna</th>
					<th>Fechas</th>
					<th>Limite <br> Re-Ingreso</th>
					<th>Acciones</th>
				</tr>
          	</thead>
          	<tbody>
			  	@forelse($projects as $project)
			  	<tr>
				  	<td>
						<small><strong>{{ $project->code }}</strong></small>
					</td>
				  	<td>
						<span title="{{ $project->name }}">{{ Str::limit($project->name, 20, '...')}}</span>
						<br>
						@php 
						$customer = $project->customer ? $project->customer->name : '-';
						@endphp
						<small title="{{ $customer }}">
							({{ Str::limit($customer, 20, '...')}})
						</small>
					</td>
					<td>
						<span class="badge super-badge bg-{{ $project->statusClassBadge() }}">{{ $project->statusForHummans() }}</span>&nbsp;&nbsp;
						<a href="{{ route('admin.projects.editStatus', $project) }}" title="Cambiar Estado"><i class="fas fa-sync-alt"></i> </a>
					</td>

					<td>
						<small>{{ $project->commune ? $project->commune->label : '-' }}</small>
						
					</td>
					<td>
					@if ($project->entry_date)	
						<strong class="badge bg-success">Ingresado</strong> : <span class="badge bg-light text-dark"> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->entry_date)->locale('es_ES')->isoFormat('D MMM YYYY') }} </span> <br>
					@endif
					@if ($project->limit_re_entry_date)
						<strong class="badge bg-danger">Limite Re-Ingreso</strong> : <span class="badge bg-light text-dark"> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->limit_re_entry_date)->locale('es_ES')->isoFormat('D MMM YYYY') }} </span><br>
					@endif
					@if ($project->re_entry_date)
						<strong class="badge bg-success">Re-ingresado</strong> : <span class="badge bg-light text-dark"> {{ $project->re_entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->re_entry_date)->locale('es_ES')->isoFormat('D MMM YYYY') : '-' }} </span>
						&nbsp;&nbsp; <a href="{{ route('admin.projects.editReEntry', $project) }}" title="Re-Ingresar Proyecto"><i class="far fa-calendar-plus"></i> </a>
					@endif
					</td>
					
					<td>
					@if ($project->entry_date)	

						{{ $project->limit_re_entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->limit_re_entry_date)->locale('es_ES')->isoFormat('D MMM YYYY') : '-' }}
					
						<br>	
					
						@if($project->re_entry_date)
							<strong class="badge bg-success">Re-Ingresado</strong><br>
								@if($project->re_entry_date > $project->limit_re_entry_date )
									<strong class="badge bg-primary">Fuera de fecha</strong>
								@endif

						@else
							@if($project->limit_re_entry_date)
								@if($project->limit_re_entry_date >= $now )
									<strong class="badge bg-warning">por Ingresar</strong>
								@else
									<strong class="badge bg-danger">Vencido <br> No Re-Ingresado</strong>
								@endif
							@endif
						@endif
					@endif
					</td>
					<td>
						<div class="dropdown">
							<button class="btn btn-gray-800 btn-sm d-inline-flex align-items-center me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-h"></i>
							</button>
							<div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
								<a title="Ver Ficha del Proyecto" class="dropdown-item d-flex align-items-center" href="{{ route('admin.projects.show', $project) }}">
									<i class="fas fa-eye dropdown-icon text-dark me-2"></i>
									Ver Ficha
								</a>
								<a title="Editar Proyecto" class="dropdown-item d-flex align-items-center" href="{{ route('admin.projects.edit', $project) }}">
									<i class="fas fa-edit dropdown-icon text-dark me-2"></i> 
									Editar
								</a>
								<a class="dropdown-item d-flex align-items-center" onclick="confirm('Estas seguro de eliminar el proyecto?') ? document.getElementById('delete-project-{{ $project->id }}').submit() : ''">
									<i class="fas fa-trash-alt dropdown-icon text-danger me-2"></i>
									Eliminar
								</a>
								@if(auth()->user()->isSuper())
								<div role="separator" class="dropdown-divider my-1"></div>
								<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.projects.invoices.index', $project->id ) }}">
									<i class="fas fa-money-check-alt dropdown-icon text-dark me-2"></i>	
									Gestión de Facturas
								</a>
								@endif
								<a class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalLinkProject{{ $project->id }}">
									<i class="fas fa-link dropdown-icon text-dark me-2"></i>	
									Link Externo
								</a>
							</div>
						</div>

						
						<!-- Modal -->
						<div class="modal fade" id="modalLinkProject{{ $project->id }}" tabindex="-1" aria-labelledby="modalLinkProject{{ $project->id }}" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-body">
										Link : <input class="col-md-8 "id="inputProject{{ $project->id }}" type="text" value="{{ route('detail_project.customer', strtr(base64_encode($project->code), '+/=', '-_')) }}">
										<button class="btn btn-primary btn-sm" onclick="copyToClipboard('inputProject{{ $project->id }}')">Copiar Link</button>
									</div>
								</div>
							</div>
						</div>

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
	<script>
	function copyToClipboard(id) {
        document.getElementById(id).select();
        document.execCommand('copy');
    }
	</script>
@endsection