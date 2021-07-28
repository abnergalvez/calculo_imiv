<br><br>
<div class="col-md-12 row">
    <div class="col-md-4">
        <a href="{{ route('inicio') }}" class="btn btn-secondary btn" >
            Solo Volver
        </a>
    </div>
<div class="col-md-4">
<form action="{{ route('mixto_guardar') }}"  method="post">
    @csrf
    <input type="hidden" name="proyecto" value="{{ $attributes['proyecto'] }}">
    <input type="hidden" name="datos_calculo" value="{{ $attributes['datos_calculo']}}" >
    <input type="hidden" name="sumatoria" value="{{ json_encode($attributes['sumatoria']) }}" >
    <button type="submit" class=" btn btn-primary" >
    Guardar calculo Mixto & Volver
    </button>
</form>
</div>
<div class="col-md-4">
    @component('components.resultados.envio_email', 
        [
            'sumatoria' => json_encode($attributes['sumatoria']),
            'proyecto' => $attributes['proyecto'],
        ])
    @endcomponent 
</div>

</div>
