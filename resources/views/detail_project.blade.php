@extends('layouts.inicial')

@section('styles')
	@parent
@endsection

@section('content')
<div class="container">
    <div class="row g-5">
        <div class="col-md-7 col-lg-12">
            <br>
            @if($project)
            <h4 class="mt-5"> Detalle Proyecto </h4>
            <div class="card">
                <div class="table-responsive ">
                    <table class="table-bordered table-secondary table  table-hover align-items-center" >
                    <tr>
                        <th width="25%" class="table-active"><strong>Nombre</strong></th>
                        <td>{{ $project->name }}</td>
                    </tr>
                    <tr>
                        <th class="table-active"><strong> Tipo / Clasificación  </strong></th>
                        <td>{{ $project->type_project->name }} </td>
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
                        <th class="table-active"><strong>Ubicación</strong> </th>
                        <td>
						{{ $project->address }}, {{ $project->commune ? $project->commune->label : '' }} ,
						{{ $project->commune ? 'Región de '.$project->commune->province->region->label : '' }}
                        </td>
                    </tr>
					<tr>
                        <th class="table-active"><strong>Estado</strong></th>
                        <td>
							<span class="badge super-badge bg-{{ $project->statusClassBadge() }}">{{ $project->statusForHummans() }}</span>&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><strong>Fechas</strong></th>
                        <td>
                            <ul><?php $status = $project->status; ?>
                                <li><strong>Primer Ingreso</strong>:&nbsp;&nbsp; 
                                    {{ $project->entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->entry_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') : ''}}
                                    @if(
                                        $status == "registered_for_observation" ||
                                        $status == "in_correction" ||
                                        $status == "re_entered" ||
                                        $status == "accepted" || 
                                        $status == "rejected"
                                        )
                                    <i class="far fa-calendar-check text-success"></i>
                                    @endif
                                </li>
                                <li><strong>Observaciones</strong>:&nbsp;&nbsp;
                                    {{ $project->observation_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->observation_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') : ' - ' }} 
                                    @if(
                                        $status == "in_correction" ||
                                        $status == "re_entered" ||
                                        $status == "accepted" || 
                                        $status == "rejected"
                                        )
                                    <i class="far fa-calendar-check text-success"></i>
                                    @endif

                                    
                                </li>
                                <li><strong>Segundo Ingreso</strong>:&nbsp;&nbsp; 
                                    {{ $project->re_entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->re_entry_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') : ' - ' }} 	
                                    @if(
                                        $status == "re_entered" ||
                                        $status == "accepted" || 
                                        $status == "rejected"
                                        )
                                    <i class="far fa-calendar-check text-success"></i>
                                    @endif
                                </li>
                                <li><strong>Aprobación / Rechazo</strong>:&nbsp;&nbsp; 
                                    {{ $project->final_status_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->final_status_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') : ' - ' }} 	
                                    @if(
                                        $status == "accepted" || 
                                        $status == "rejected"
                                        )
                                    <i class="far fa-calendar-check text-success"></i>
                                    @endif
                                </li>
                            </ul>    
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><strong>Entidad Revisora</strong> </th>
                        <td>
						    {{ $project->reviser ? $project->reviser->name : '-' }}
                        </td>
                    </tr>
                    

					<tr>
                        <th class="table-active"><strong>Documentos Proyecto</strong></th>
                        <td>
                        @if($project->entry_doc_path)
							<a class="btn btn-secondary" target="_blank" href="{{ Storage::url($project->entry_doc_path) }}"><i class="fas fa-cloud-download-alt"></i> Ingreso </a> 
						@endif
                        @if($project->re_entry_doc_path)	
							<a class="btn btn-info" target="_blank" href="{{ Storage::url($project->re_entry_doc_path) }}"><i class="fas fa-cloud-download-alt"></i> Re-Ingreso </a>
                        @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <th class="table-active"><strong>Link de Aprobación</strong></th>
                        <td>
                        @if($project->approval_link)
							<a class="" target="_blank" href="{{ $project->approval_link }}">{{ $project->approval_link }}</a> 
						@else
                        -
                        @endif
                        </td>
                    </tr>
                    
                </table>
                </div>
            </div>
            @else
            <p class="mt-5">No existe el proyecto que buscas...</p>
            @endif       
        </div>
    </div>
</div>
@endsection

@section('scripts')
	@parent
@endsection