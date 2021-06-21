<div class="py-5 text-center mt-4">
    <h2>Calculo IMIV - Resultado</h2>
    <h3>{{ $attributes['proyecto'] }} - {{ $attributes['subproyecto'] }} - {{ $attributes['escala'] }}</h3>
</div>

@if($attributes['superficie'])
Sumatoria total proyecto con {{ $attributes['superficie'] }} MT<sup>2</sup> de superficie <br>
@else
Calculo para {{ $attributes['cantidad'] }} ({{ $attributes['modelo']::labelIngreso($attributes['subproyecto_key']) }})  - {{ $attributes['subproyecto'] }}  <br><br>
@endif