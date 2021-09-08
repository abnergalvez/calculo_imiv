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

	<x-resultados.tabla_entradas_casadeptos 
		:entradas="$resultado_entradas"
	/>
	<hr>
	<x-resultados.tabla_salidas_casadeptos 
		:salidas="$resultado_salidas"
	/>
	<hr>
	<x-resultados.tabla_sumatoria_casadeptos 
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
	<x-resultados.btn_volver 
		tipo_calculo=normal
		:proyecto="$proyecto"
		:sumatoria="$sumatoria"
		:datos_calculo="$datos_calculo"
		:entradas="$resultado_entradas"
		:salidas="$resultado_salidas"
		:suma_otros="$suma_otros"
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