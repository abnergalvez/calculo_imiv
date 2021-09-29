<div class="py-5 text-center mt-4">
    <h2>Calculo IMIV - Resultado</h2>
      <h3>{{ App\Models\FuncionesCalculos::fullProyectos()[$attributes['proyecto']]['label'] }}</h3>
</div>
<br>
    <x-resultados.periodos />
<br>

<p>Calculo para:</p>
<ul>
    @foreach($attributes['superficies'] as $key => $value) 
    <li>
        {{ $attributes['cantidades'][$key] }} Contrucciones
    </li> 
    <li>
       Total de  {{ $value }} MT<sup>2</sup>
    </li> 
    @endforeach
</ul>