<div>
@if (session('calculo_mixto') && count($proyectos_mixtos['proyectos']) > 0 )
    <hr> 
    <form action="{{ $ruta }}" name="formulario_mixto" method="get">
    <h4 class="mb-3"> Datos calculo Mixto</h4>
    <ul>
    @foreach($proyectos_mixtos['proyectos'] as $key => $proyecto )
       <li> <h4 class="badge bg-primary"> Calculo {{ $key+1 }} </h4> : 
            <strong> {{ App\Models\FuncionesCalculos::fullProyectos()[$proyecto]['label'] }} </strong> - {{ $proyectos_mixtos['datos_calculo'][$key] }}
            <a  class="btn btn-danger btn-sm" wire:click="remove({{ $key }})"> <i class="bi bi-trash"></i></a>
        </li>
    @endforeach
    </ul>
    <div class="col-md-4">
    <button type="submit" class="btn btn-primary btn-lg" >Calcular</button>
    </div>
    </form> 
@endif
</div>
