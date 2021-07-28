<br><br>
<div class="col-md-12 row">
    <div class="col-md-4">
        <a href="{{ route('inicio') }}" class="btn btn-secondary btn" >
            Solo Volver
        </a>
    </div>
<div class="col-md-4">
    <a href="{{ route('mixto_borrar') }}" class="btn btn-primary btn " >
        Volver y limpiar calculo Mixto
    </a>
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
