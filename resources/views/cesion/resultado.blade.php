@extends('layouts.inicial')

@section('styles')
	@parent
@endsection

@section('content')
<div class="container">
    <x-inicio.descripcion_cesion />
    <strong>Valores Iniciales</strong>
    <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Valor Carga de Ocupación </th>
                <th>Sup. Neta Terreno</th>
                <th>Sup. Bruta Terreno</th>
                <th> Avaluo Terreno Propio ($CLP)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $carga_ocupacion }} M<sup>2</sup></td>
                <td>{{ $sup_neta_terreno }} M<sup>2</sup></td>
                <td>{{ $sup_bruta_terreno }} M<sup>2</sup></td>
                <td> ${{  $avaluo_terreno_propio }}</td>   
            </tr>
        </tbody>
    </table>

    <hr class="my-4">
    <h4>Resultados</h4>

    <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Densidad Ocupación</th>
                <th>Porcentaje de Cesión</th>
                <th>Cant. Superficie Cesión (M<sup>2</sup>)</th>
                <th>Aporte Monetario Cesión ($CLP)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{  round($resultado_do, 2 ) }}</td>
                <td>{{  round($resultado_cesion, 2 ) }} %</td>
                <td>{{  $cesion_m2 != '-' ? round($cesion_m2, 2 ) : '-' }} M<sup>2</sup></td>
                <td> ${{  $aporte_cesion_clp != '-' ? round($aporte_cesion_clp): '-' }}</td>   
            </tr>
        </tbody>
    </table>
    
  



</div>
@endsection

@section('scripts')
	@parent
@endsection