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

    <x-resultados.tabla_sumatoria_otros 
        :sumatoria="$sumatoria"
    />

    <x-resultados.estudio_imiv 
        :max_t_privado="$max_t_privado"
        :imiv_t_privado="$imiv_t_privado "
        :max_t_otros="$max_t_otros"
        :imiv_t_otros="$imiv_t_otros"
    />    
    <a href="{{ route('inicio') }}" class="w-100 btn btn-secondary btn-lg" >Volver</a>
</div>
@endsection

@section('scripts')
	@parent
@endsection