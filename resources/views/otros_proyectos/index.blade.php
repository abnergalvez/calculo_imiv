@extends('layouts.resultados')

@section('styles')
	@parent
@endsection

@section('content')
<div class="container">
    <div class="py-5 text-center mt-5">
        <h2>Calculo IMIV - Resultado</h2>
	    <h3>{{ $proyecto }} - {{ $subproyecto }} - {{ $escala }}</h3>
    </div>

<div class="accordion accordion-flush" id="accordionFlushExample">

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseTwo">
      SUMATORIA  (clic para ver detalles)
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      <ul>
        <?php
          if($superficie !='') {
           echo '<li> Sumatoria total proyecto con '.$superficie.' MT<sup>2</sup> de superficie </li>'; 
          }

          if($cantidad !='') {
            echo '<li> Sumatoria total  para '.$cantidad.' de cantidad  </li>'; 
           }

           
        ?> 
        

      </ul>
    <div class="row g-5">

        <table class="table table-hover table-sm">
          <thead>
            <tr> 
              <th scope="col">Periodos</th>
              <th scope="col">Autos </th>
              <th scope="col">T. Publico </th>
              <th scope="col">Peatones </th>
              <th scope="col">Ciclos </th>
            </tr>
          </thead>
          <tbody>
		   	@php
			   $periodos = array("PM-L", "PMd-L", "PT-L", "PMd-F","PT-F");
			@endphp

            @foreach($sumatoria as $key => $value)
            <tr>
              <td>{{ $periodos[$key] }}</td>
              <td>{{ $value["transporte_privado"] }}</td>
              <td>{{ $value["transporte_publico"] }}</td>
              <td>{{ $value["peatones_viajes"] }}</td>
              <td>{{ $value["ciclos_viajes"] }}</td>
            </tr>
			@endforeach

          </tbody>
        </table>
    </div>


      </div>
    </div>
  </div>



</div>

        <br>

       <h4>Maximo Valor: <span class="badge bg-dark">transporte privado</span> es: <span class="badge bg-secondary">{{ $max_t_privado }}</span></h4>
	   <p>Estudio IMIV requerido:  <span class="badge bg-primary">{{ $imiv_t_privado }}</span></p>
       
       <h4>Maximo Valor: <span class="badge bg-dark">otros transportes</span> es: <span class="badge bg-secondary"> {{ $max_t_otros }}</span></h4>
       <p></span>Estudio IMIV requerido: <span class="badge bg-primary">{{ $imiv_t_otros }}</span></p>      
        

          <a href="{{ route('inicio') }}" class="w-100 btn btn-secondary btn-lg" >Volver</a>
    </div>

</div>
@endsection

@section('scripts')
	@parent
@endsection