@extends('layouts.resultados')

@section('styles')
	@parent
@endsection

@section('content')
<div class="container">
	<x-resultados.titulo_casadeptos
		:proyecto="$proyecto"
		:superficies="$superficies"
		:cantidades="$cantidades"
	/>

	<x-resultados.tabla_sumatoria_casadeptos 
		:sumatoria="$sumatoria"
	/>

	<x-resultados.estudio_imiv 
		:max_t_privado="$max_t_privado"
		:imiv_t_privado="$imiv_t_privado "
		:max_t_otros="$max_t_otros"
		:imiv_t_otros="$imiv_t_otros"
	/>	
	  
	<x-resultados.btn_volver />
	
</div>
@endsection
@section('scripts')
	@parent
@endsection