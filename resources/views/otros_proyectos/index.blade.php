@extends('layouts.resultados')

@section('styles')
	@parent
@endsection

@section('content')
<div class="container">
    
    <x-resultados.titulo_otros 
        :proyecto="$proyecto"
        :subproyecto="$subproyecto"
        :escala="$escala"
        :superficie="$superficie"
        :cantidad="$cantidad"
        :modelo="$modelo"
        :subproyecto_key="$subproyecto_key"
    />
    <x-resultados.tabla_entradas_otros
		:entradas="$resultado_entradas"
	/>
	<hr>
	<x-resultados.tabla_salidas_otros
		:salidas="$resultado_salidas"
	/>
	<hr>
    <x-resultados.tabla_sumatoria_otros 
        :sumatoria="$sumatoria"
    />

    <x-resultados.estudio_imiv 
        :max_t_privado="$max_t_privado"
        :imiv_t_privado="$imiv_t_privado "
        :max_t_otros="$max_t_otros"
        :imiv_t_otros="$imiv_t_otros"
    />  
     
    <x-resultados.btn_volver 
		:proyecto="$proyecto"
		:sumatoria="$sumatoria"
		:datos_calculo="$datos_calculo"
	/>
    
</div>
@endsection

@section('scripts')
	@parent
@endsection