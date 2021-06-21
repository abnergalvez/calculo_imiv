@extends('layouts.inicial')

@section('styles')
	@parent
@endsection

@section('content')
<div class="container">
    <x-inicio.descripcion />


    <div class="row g-5">
        <div class="col-md-7 col-lg-12">
            <hr class="my-4">
            <h4 class="mb-3"> Datos a ingresar</h4>
            <form class="needs-validation" id="formulario_inicial" action="{{ route('calculo') }}" name="formulario_inicial" method="post">
                @csrf
                @livewire('proyecto-subproyecto-escala')
                <div id="formulario" class="row g-3">
                </div>
                <hr class="my-4">
                <button type="submit" class="w-100 btn btn-primary btn-lg" >Calcular</button>
            </form>
        </div>
    </div>


</div>
@endsection

@section('scripts')
	@parent
@endsection