<div class="col-md-12">
<h4>Resultados</h4>
 <p> Los resultados se obtienen a partir del procesado de los datos y 
la elección de la exigencia máxima (Estudio IMIV e Intersecciones ) segun la comparación 
de transporte privado y transporte público</p>
<div class="col-md-7">
<table class="table table-striped table-bordered nowrap " cellspacing="0" width="100%" style="width:100% !important;border: 3px solid;">
    <thead class="table-dark">
        <tr>
            <th>Tipo Transporte</th>
            <th>Máximo Valor</th>
            <th>Estudio IMIV Requerido</th>
            <th>Intersecciones por Ruta</th>

        </tr>
    </thead>
    <tbody style="font-weight: bold;">
        <tr>
            <td>Privado</td>
            <td>{{ $attributes['max_t_privado'] }}</td>
            <td>{{ $attributes['imiv_t_privado']['imiv'] }} </td>
            <td>{{ $attributes['imiv_t_privado']['cruces'] }} </td>
        </tr>
        <tr>
            <td>Otros medios de transporte</td>
            <td>{{ $attributes['max_t_otros'] }}</td>
            <td>{{ $attributes['imiv_t_otros']['imiv'] }} </td>
            <td>{{ $attributes['imiv_t_otros']['cruces'] }} </td>
        </tr>
    </tbody>
</table>
</div>
<br>

    @if($attributes['tipo'] == 'casas' || $attributes['tipo'] == 'departamentos')
    <div class="border border-dark border-3 col-md-7 p-2">
        <strong>Superficie Útil construida : {{ $attributes['superficies'][0] }}     Mt<sup>2</sup> </strong>  <br>
        <strong>Numero de {{ ucfirst($attributes['proyecto']) }} : {{ $attributes['cantidades'][0] }}   Unidades</strong> 
    </div>
    @endif
    @if($attributes['tipo'] == 'otros')
    <div class="border border-dark border-3 col-md-7 p-2">
        <strong> {{ $attributes['subproyecto'] }} </strong><br>
        @if($attributes['superficie'])    
            <strong>Superficie Útil construida : {{ $attributes['superficie'] }}     Mt<sup>2</sup> </strong>  <br>
        @else
            <strong>{{ $attributes['modelo']::labelIngreso($attributes['subproyecto_key']) }} : {{ $attributes['cantidad'] }}   Unidades</strong> 
        @endif
    </div>
    @endif

    @if($attributes['tipo'] == 'mixto')

    @endif

</div>