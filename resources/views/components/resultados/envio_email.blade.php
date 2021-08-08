<div>
    <form action="{{ route('resultados_por_email') }}"  method="post">
        @csrf
        <div class="input-group mb-4">
            <input type="text" name="email" class="form-control" placeholder="Ingrese email destino" aria-label="Email destino">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">
                Enviar Resultados
                </button>
            </div>
        </div>
        <input type="hidden" name="proyecto" value="{{ $proyecto }}"/>
        <input type="hidden" name="tipo_calculo" value="{{ $tipo_calculo }}"/>
        <input type="hidden" name="texto_datos" value="{{ $datos_calculo }}"/>
        <input type="hidden" name="entradas" value="{{ isset($entradas) ? $entradas : '' }}"/>
        <input type="hidden" name="salidas" value="{{ isset($salidas) ? $salidas : ''  }}"/>
        <input type="hidden" name="sumatoria" value="{{ $sumatoria }}"/>
        <input type="hidden" name="suma_otros" value="{{ $suma_otros }}"/>
        <input type="hidden" name="maximo_t_privado" value="{{ $max_t_privado }}"/>
        <input type="hidden" name="maximo_t_otros" value="{{ $max_t_otros }}"/>
        <input type="hidden" name="estudio_t_privado" value="{{ $imiv_t_privado }}"/>
        <input type="hidden" name="estudio_t_otros" value="{{ $imiv_t_otros }}"/>
    </form>
</div>