<br>
<h4>Maximo Valor: 
    <span class="badge bg-dark">
        transporte privado
    </span> es: 
    <span class="badge bg-secondary">
        {{ $attributes['max_t_privado'] }}
    </span>
</h4>

<p>
    Estudio IMIV requerido:  
    <span class="badge bg-primary">
        {{ $attributes['imiv_t_privado']['imiv'] }} <br>
    </span>
</p>
<p>
    Cantidad Intersecciones:  
    <span class="badge bg-secondary">
        {{ $attributes['imiv_t_privado']['cruces'] }}
    </span>
</p>
       
<h4>Maximo Valor: 
    <span class="badge bg-dark">
        otros transportes
    </span> es: 
    <span class="badge bg-secondary">
        {{ $attributes['max_t_otros'] }}
    </span>
</h4>

<p>
    Estudio IMIV requerido: 
    <span class="badge bg-primary">
        {{ $attributes['imiv_t_otros']['imiv']  }}<br>
    </span>
</p>
<p>
Cantidad Intersecciones: 
    <span class="badge bg-secondary">
        {{ $attributes['imiv_t_otros']['cruces']  }}
    </span>
</p>