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
                            <ul>
                                <li><strong>Primer Ingreso</strong>:&nbsp;&nbsp; 
                                    {{ $project->entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->entry_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') : ''}}
                                
                                </li>
                                <li><strong>Observaciones</strong>:&nbsp;&nbsp;
                                    {{ $project->observation_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->observation_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') : ' - ' }} 
                                    @if($project->limit_observation_date)
                                    <small class="mx-8 float-end">Fecha Limite : 
                                        <span class="badge bg-warning">
                                            {{  $project->observation_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->observation_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') : '-' }}
                                        </span>
                                    </small>
                                    @endif
                                    
                                </li>
                                <li><strong>Segundo Ingreso</strong>:&nbsp;&nbsp; 
                                    {{ $project->re_entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->re_entry_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') : ' - ' }} 	
                                    @if($project->limit_re_entry_date)
                                    <small class="mx-8 float-end">Fecha Limite : 
                                        <span class="badge bg-warning">
                                            {{ $project->limit_re_entry_date ?  \Carbon\Carbon::createFromFormat('Y-m-d', $project->limit_re_entry_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') : ' - ' }}
                                        </span>
                                    </small>
                                    @endif
                                </li>
                                <li><strong>Aprobación / Rechazo</strong>:&nbsp;&nbsp; 
                                    {{ $project->final_status_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->final_status_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') : ' - ' }} 	
                                    @if($project->limit_final_status_date)
                                    <small class="mx-8 float-end">Fecha Limite : 
                                        <span class="badge bg-warning">
                                            {{ $project->limit_final_status_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->limit_final_status_date)->locale('es_ES')->isoFormat('D MMMM  YYYY'): ' - ' }}
                                        </span>
                                    </small>
                                    @endif
                                </li>
                            </ul>    
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active">Entidad Revisora</th>
                        <td>
						    {{ $project->reviser ? $project->reviser->name : '-' }}
                        </td>
                    </tr>
                    @if(auth()->user()->isSuper())
                    <tr>
                        <th class="table-active"><strong>Presupuesto</strong></th>
                        <td>
                            @if($project->budget)
                            # {{ $project->budget->number }} <small>(Numero) </small>  
                                @if($project->budget->status)
                                -
                                <span class="badge bg-{{ $project->budget->statusLabels()['class']  }}">{{ $project->budget->statusLabels()['label'] }} </span>
                                @endif 

                                @if($project->budget->doc_path)
                                -  
                                <a href="{{ Storage::url($project->budget->doc_path) }}" target="_blank" title="Descargar"><i class="fas fa-download  text-white"></i></a>
                                @endif
                                <br>
                                @if($project->budget->accepted_date)
                                <strong>Fecha Aceptacion </strong>:&nbsp;&nbsp; 
                                    {{ $project->budget->accepted_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->budget->accepted_date )->locale('es_ES')->isoFormat('D MMMM  YYYY') : ' - ' }} 	
                                <br>
                                @endif

                                @if($project->budget->entry_date)
                                <strong>Fecha Ingreso </strong>:&nbsp;&nbsp; 
                                    {{ $project->budget->entry_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $project->budget->entry_date )->locale('es_ES')->isoFormat('D MMMM  YYYY') : ' - ' }} 	
                                    @if($project->budget->limit_entry_date)
                                    <small class="mx-8 float-end">Fecha Limite : 
                                        <span class="badge bg-warning">
                                            {{  \Carbon\Carbon::createFromFormat('Y-m-d', $project->budget->limit_entry_date)->locale('es_ES')->isoFormat('D MMMM  YYYY') }}
                                        </span>
                                    </small>
                                    @endif
                                @endif
                            @endif
						</td>
                    </tr>
                    @endif
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
							<a class="text-white" target="_blank" href="{{ $project->approval_link }}">{{ $project->approval_link }}</a> 
						@else
                        -
                        @endif
                        </td>
                    </tr>
                    @if(auth()->user()->isSuper())
                    <tr>
                        <th class="table-active"><strong>Facturas</strong></th>
                        <td>
                            <ul>
                                @forelse($project->invoices as $invoice)
                                <li># {{ $invoice->number }} <small>(Numero) </small> - 
                                    <span class="badge bg-{{ $invoice->statusLabels()['class']  }}">{{ $invoice->statusLabels()['label'] }} </span>
                                    -  
                                    @if($invoice->doc_path)
                                    <a href="{{ Storage::url($invoice->doc_path) }}" target="_blank" title="Descargar"><i class="fas fa-download  text-white"></i></a>
                                    @endif
                                </li>
                                @empty
                                @endforelse
                            </ul>
						</td>
                    </tr>
                    @endif
                    
                </table>
		</div>
	</div>
@endsection
@section('scripts')
	@parent
@endsection