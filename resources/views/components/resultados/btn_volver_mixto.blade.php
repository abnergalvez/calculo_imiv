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
            'proyecto' => json_encode($attributes['proyecto']),
            'datos_calculo' => json_encode($attributes['datos_calculo']),
            'suma_otros' => json_encode($attributes['suma_otros']),
            'max_t_privado' => $attributes['max_t_privado'],
            'imiv_t_privado' => json_encode($attributes['imiv_t_privado']),
            'max_t_otros' => $attributes['max_t_otros'],
            'imiv_t_otros' => json_encode($attributes['imiv_t_otros']),
            'tipo_calculo' => $attributes['tipo_calculo'],
        ])
    @endcomponent 
</div>
</div>
