<div>
    <div class="row g-3">
        <div class="col-md-4">
            <label for="country" class="form-label fw-bold" >{{ __('Categoria') }}</label>
            <select wire:model="selectedProyectos" class="form-select"  name="proyecto" autocomplete="off" required>
                <option value="" selected>Selecciona Categoria</option>
                @foreach($proyectos as $key => $value)
                    <option value="{{ $key }}">{{ $value['label'] }}</option>
                @endforeach
            </select>
        </div>

        @if (!is_null($selectedProyectos))
            <div class="col-md-6">
                <label for="state" class="form-label fw-bold">{{ __('Proyecto') }}</label>
                <select wire:model="selectedSubproyectos" class="form-select" name="subproyecto" required>
                    <option value="" selected>Selecciona Proyecto</option>
                    @foreach($subproyectos as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        @if (!is_null($selectedSubproyectos) && $escalas )
            <div class="col-md-2">
                <label for="city" class="form-label fw-bold">{{ __('Escala') }}</label>
                <select wire:model="escalas" class="form-select" name="escala" required>
                    <option value="" selected>Selecciona Escala</option>
                    @foreach($escalas as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>
    
    @if ($formulario_normal)
    <div  class="row g-3">    
        <div class="col-md-12 my-2">
            <hr>
        </div>
        <br>
        <div class="col-md-3 form-floating ">
            <input  type="text" class="form-control" name="{{ $tipo_calculo}}" id="floatingInput" required>
            <label class="px-4" for="floatingInput">{{ $tipo_calculo_label }}</label>
        </div>
    </div>
    @endif

    <input  type="hidden" class="" value="{{ $modelo }}" name="modelo" required>


</div>