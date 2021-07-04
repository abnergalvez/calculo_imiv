<div class="py-5 text-center mt-4">
    <h2>Calculo IMIV - Calculo Mixto - Resultado</h2>
</div>
<p>Calculo para:</p>
<ul>
    @foreach($attributes['datos'] as $key => $value) 
    <li>  
    {{ $attributes['proyectos'][$key] }} {{ $value }} 
    </li> 
    @endforeach
</ul>