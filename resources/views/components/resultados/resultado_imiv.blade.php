<div class="col-md-12">
<h4>Resultados</h4>
 <p> Los resultados se obtienen a partir del procesado de los datos y 
la elección de la exigencia máxima (Estudio IMIV e Intersecciones ) segun la comparación 
de transporte privado y transporte público</p>
<table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%" style="width:auto !important;border: 3px solid;">
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