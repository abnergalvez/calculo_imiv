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
    <br>
	<div class="row">

        <x-resultados.resultado_imiv 
            :datos_comparacion="$datos_comparacion"
			:imiv_t_privado="$imiv_t_privado"
			:imiv_t_otros="$imiv_t_otros"
			:max_t_otros="$max_t_otros"
			:max_t_privado="$max_t_privado"
        />   
    </div>
	<x-resultados.btn_volver_mixto 

        tipo_calculo=mixto
		:proyecto="$proyectos"
		:sumatoria="$sumatoria"
        :suma_otros="$suma_otros"
		:datos_calculo="$datos"
		:max_t_privado="$max_t_privado"
		:imiv_t_privado="$imiv_t_privado "
		:max_t_otros="$max_t_otros"
		:imiv_t_otros="$imiv_t_otros"
    
    />  
    
</div>
@endsection

@section('scripts')
	@parent
@endsection