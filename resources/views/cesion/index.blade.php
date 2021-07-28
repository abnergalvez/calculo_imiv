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
                <label for="cant_sup" class="form-label fw-bold">Ingrese Carga de Ocupación *</label>
                <input  type="number" min="1" class="form-control" name="carga_ocupacion"  required>
            </div>
            <div class="col-md-4 ">
                <label for="cant_sup" class="form-label fw-bold">Ingrese Superficie Bruta del terreno *</label>
                <input  type="number" min="1" class="form-control" name="sup_bruta_terreno"  required>
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