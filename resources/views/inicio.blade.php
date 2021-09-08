@extends('layouts.inicial')

@section('styles')
	@parent
@endsection

@section('content')
<div class="container">
    <x-inicio.descripcion_imiv />
    

        @livewire('proyectos-mixto')

    <div class="row g-5">
        <div class="col-md-7 col-lg-12">
            <hr class="my-4">
            <h4 class="mb-3"> Datos calculo por Proyecto</h4>
            
                @livewire('proyecto-subproyecto-escala')
                
        </div>
    </div>


</div>
@endsection

@section('scripts')
	@parent
@endsection