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
        <input type="hidden" name="tipo_calculo" value=""/>
        <input type="hidden" name="texto_datos" value=""/>
        <input type="hidden" name="entradas" value=""/>
        <input type="hidden" name="salidas" value=""/>
        <input type="hidden" name="sumatoria" value="{{ $sumatoria }}"/>
        <input type="hidden" name="maximo_t_privado" value=""/>
        <input type="hidden" name="maximo_t_otros" value=""/>
        <input type="hidden" name="estudio_t_privado" value=""/>
        <input type="hidden" name="estudio_t_otros" value=""/>
    </form>
</div>