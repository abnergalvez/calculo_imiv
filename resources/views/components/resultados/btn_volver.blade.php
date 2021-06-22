<div class="col-md-12 row">
<a href="{{ route('inicio') }}" class="p-3 col-md-4 btn btn-secondary btn-lg" >
    Solo Volver
</a>
<div class="col-md-4">
<form action="{{ route('mixto_guardar') }}"  method="post">
    @csrf
    <input type="hidden" name="proyecto" value="{{ $attributes['proyecto'] }}">
    <input type="hidden" name="datos_calculo" value="{{ $attributes['datos_calculo']}}" >
    <input type="hidden" name="sumatoria" value="{{ json_encode($attributes['sumatoria']) }}" >
    <button type="submit" class=" btn btn-primary btn-lg " >
    Guardar para Calculo MIXTO/ Volver
    </button>
</form>
</div>
</div>
