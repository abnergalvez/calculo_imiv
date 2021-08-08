@extends('layouts.resultados')

@section('styles')
	@parent
@endsection

@section('content')
<div class="container">
	<x-resultados.titulo_mixto 
        :proyectos="$proyectos"
        :datos="$datos"
    />

    <x-resultados.tabla_sumatoria_mixto 
        :sumatoria="$sumatoria"
        :suma_otros="$suma_otros"
    />

    <x-resultados.estudio_imiv 
        :max_t_privado="$max_t_privado"
        :imiv_t_privado="$imiv_t_privado "
        :max_t_otros="$max_t_otros"
        :imiv_t_otros="$imiv_t_otros"
    />

	<x-resultados.btn_volver_mixto />  
    
</div>
@endsection

@section('scripts')
	@parent
@endsection