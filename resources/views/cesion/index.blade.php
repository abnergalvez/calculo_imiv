@extends('layouts.inicial')

@section('styles')
	@parent
@endsection

@section('content')
<div class="container">
    
    <x-inicio.descripcion_cesion />
    

    
    <form class="needs-validation"  action="{{ route('calculo.cesion') }}" method="post">
        @csrf
        <div class="row g-3">
            <div class="col-md-4 ">
                <label for="" class="form-label fw-bold"> Superficie Vivienda (M<sup>2</sup>) *</label>
                <input  type="number" min="1" class="form-control" name="sup_vivienda" title="Solo superficie de lo construido" required>
            </div>
            <div class="col-md-4 ">
                <label for="" class="form-label fw-bold"> Superficie Bruta del terreno(M<sup>2</sup>) *</label>
                <input  type="number" min="1" class="form-control" name="sup_bruta_terreno" title="Sup. Adjacente (Calle) + Sup. Total del Terreno de la Vivienda" required>
            </div>

            <hr>
            <p>Si desea calcular tambien la Cesión en M<sup>2</sup> y calculo de aporte monetario en $ (CLP) Ingrese lo siguiente:</p>
            
            <div class="col-md-4 ">
                <label for="" class="form-label fw-bold"> Superficie Neta del terreno(M<sup>2</sup>) de la vivienda </label>
                <input  type="number" min="1" class="form-control" name="sup_neta_terreno" title="Sup. Total del Terreno de la Vivienda">
            </div>
            <div class="col-md-4 ">
                <label for="" class="form-label fw-bold">Avaluo del Terreno Propio $ (CLP)</label>
                <input  type="number" min="1" class="form-control" name="avaluo_terreno_propio" title="Avaluo Terreno Propio (Cert. Avaluo Fiscal)">
            </div>

        </div>
        <hr class="my-4">
        <button type="submit" class="w-100 btn btn-primary btn-lg" >Calcular</button>
    </form>



</div>
@endsection

@section('scripts')
	@parent
@endsection