@extends('layouts.dashboard')
@section('styles')
	@parent
@endsection
@section('content_dashboard')
<div class="card">
	<div class="table-responsive ">
				<table class="table-bordered table-dark table  table-hover align-items-center" >
                    <tr>
                        <th width="25%" class="table-active"><strong>Nombre</strong></th>
                        <td>{{ $project->name }}</td>
                    </tr>
                    <tr>
                        <th class="table-active"><strong> Tipo / Clasificación  </strong></th>
                        <td>{{ $project->type_project->name }} </td>
                    </tr>
					<tr>
                        <th class="table-active"><strong>Estado</strong></th>
                        <td>
							<span class="badge super-badge bg-{{ $project->statusClassBadge() }}">{{ $project->statusForHummans() }}</span>&nbsp;&nbsp;
                        </td>
                    </tr>
					<tr>
                        <th class="table-active"><strong>Cliente</strong></th>
                        <td>
							{{ $project->customer ? $project->customer->name : ' - ' }}
	                        </td>
                    </tr>
					<tr>
                        <th class="table-active"><strong> Código   </strong></th>
                        <td>{{ $project->code }} </td>
                    </tr>
                    <tr>
                        <th class="table-active"><strong>N° de Ingreso</strong></th>
                        <td>{{ $project->entry_number }}</td>
                    </tr>
                    <tr>
                        <th class="table-active"><strong>Descripción</strong></th>
                        <td>{{ $project->description }}</td>
                    </tr>
                    <tr>
                        <th class="table-active">Ubicación</th>
                        <td>
						{{ $project->address }}, {{ $project->commune ? $project->commune->label : '' }} ,
						{{ $project->commune ? 'Región de '.$project->commune->province->region->label : '' }}
                        </td>
                    </tr>

                    <tr>
                        <th class="table-active"><strong>Fechas</strong></th>
                        <td>
                            @if($project->entry_date)
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->entry_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') }} ( F. Ingreso) <br>
							 <br>
							 {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->limit_re_entry_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') }} ( F. Limite Re-Ingreso) <br><br>
							 {{ $project->re_entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->re_entry_date)->locale('es_ES')->isoFormat('D MMMM  YYYY').' ' : ' - ' }}( F. Re-Ingreso)  <br>	
                            @else
                            -
                            @endif
                        </td>
                    </tr>

					<tr>
                        <th class="table-active"><strong>Documentos</strong></th>
                        <td>
							<a class="btn btn-secondary" target="_blank" href="{{ Storage::url($project->entry_doc_path) }}"><i class="fas fa-cloud-download-alt"></i> Ingreso </a> 
							
							<a class="btn btn-info" target="_blank" href="{{ Storage::url($project->re_entry_doc_path) }}"><i class="fas fa-cloud-download-alt"></i> Re-Ingreso </a>
                        </td>
                    </tr>
                    
                </table>
		</div>
	</div>
@endsection
@section('scripts')
	@parent
@endsection