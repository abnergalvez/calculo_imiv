<br><br>
<div class="col-md-12 row">
    <div class="col-md-4">
        <a href="{{ route('inicio') }}" class="btn btn-secondary btn" >
            Solo Volver
        </a>
    </div>
<div class="col-md-4">
<form action="{{ route('mixto_guardar') }}"  method="post">
    @csrf
    <input type="hidden" name="proyecto" value="{{ $attributes['proyecto'] }}">
    <input type="hidden" name="datos_calculo" value="{{ $attributes['datos_calculo']}}" >
    <input type="hidden" name="sumatoria" value="{{ json_encode($attributes['sumatoria']) }}" >
    <button type="submit" class=" btn btn-primary" >
    Guardar calculo Mixto & Volver
    </button>
</form>
</div>
<div class="col-md-4">
    <div class="input-group mb-4">
        <input type="text" class="form-control" placeholder="Ingrese email destino" aria-label="Email destino" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-success" type="button">Enviar Resultados</button>
        </div>
      </div>
</div>

</div>
