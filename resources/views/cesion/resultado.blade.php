@extends('layouts.inicial')

@section('styles')
	@parent
@endsection

@section('content')
<div class="container">
    <x-inicio.descripcion_cesion />
    <h4>Resultados</h4>
    <hr class="my-4">
    <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Densidad Ocupación</th>
                <th>Calculo de Cesión</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $resultado_do }}</td>
                <td>{{ $resultado_cesion }}</td>   
            </tr>
        </tbody>
    </table>
    <hr class="my-4">
  



</div>
@endsection

@section('scripts')
	@parent
@endsection