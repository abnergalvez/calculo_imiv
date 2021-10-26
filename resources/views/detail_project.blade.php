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
                            <td></td>
                        </tr>
                        <tr>
                            <th class="table-active"><strong>Estado</strong></th>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-active"><strong>Cliente</strong></th>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-active"><strong> Código   </strong></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="table-active"><strong>N° de Ingreso</strong></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="table-active"><strong>Descripción</strong></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="table-active">Ubicación</th>
                            <td>
                           
                            </td>
                        </tr>

                        <tr>
                            <th class="table-active"><strong>Fechas</strong></th>
                            <td>

                            </td>
                        </tr>

                        <tr>
                            <th class="table-active"><strong>Documentos</strong></th>
                            <td>
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