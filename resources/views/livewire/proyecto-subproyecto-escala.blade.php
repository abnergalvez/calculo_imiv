<div>
        @if($proyecto_seleccionado == "casas" || $proyecto_seleccionado == "departamentos")
            <!--<x-inicio.tipos_vivienda  />-->
        @endif
    <form class="needs-validation" id="formulario_inicial" action="{{ $ruta }}" name="formulario_inicial" method="post">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label for="proyecto" class="form-label fw-bold" >{{ __('Categoria') }}</label>
            <select wire:model="proyecto_seleccionado" class="form-select" name="proyecto" autocomplete="off" required>
                <option value="" selected>Selecciona Categoria</option>
                @forelse($proyectos as $key => $value)
                    <option value="{{ $key }}">{{ $value['label'] }}</option>
                @empty
                @endforelse
            </select>
        </div>
        @if($proyecto_seleccionado == "casas" || $proyecto_seleccionado == "departamentos")
        
        <div class="col-md-4">
            <label class="form-label fw-bold" for="superficie1">Superficie Util Construida en m<sup>2</sup> </label>
            <input placeholder="Superficie Util Construida" type="number" min="1" placeholder="0.00" step="any" class="form-control" name="superficies[]" id="superficie1" required>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold" for="cantidad1">Número de {{ $proyecto_seleccionado == "departamentos" ? 'Departamentos' : 'Viviendas'}}</label>
            <input placeholder="Número de {{ $proyecto_seleccionado == 'departamentos' ? 'Departamentos' : 'Viviendas'}}" min="1" type="number" class="form-control" name="cantidades[]" id="cantidad1" required>
            
        </div>

        @endif
        
        @if (!empty($proyecto_seleccionado) && empty($casasDeptos))
            <div class="col-md-6">
                <label for="subproyecto" class="form-label fw-bold">{{ __('Proyecto') }}</label>
                <select wire:model="subproyecto_seleccionado" class="form-select" name="subproyecto" required>
                    <option value="" selected>Selecciona Proyecto</option>
                    @forelse($subproyectos as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        @endif

        @if (!empty($escalas))
            <div class="col-md-2">
                <label for="escala" class="form-label fw-bold">{{ __('Escala') }}</label>
                <select wire:model="escala_seleccionada" class="form-select" name="escala" required>
                    <option value="" selected>Selecciona Escala</option>
                    @forelse($escalas as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        @endif

        @if ($formulario_normal)
        <div class="col-md-4 ">
            <label for="cant_sup" class="form-label fw-bold">Ingrese {{ $tipo_calculo_label }}</label>
            <input  
                type="number" 
                min="1" 
                class="form-control" 
                name="{{ $tipo_calculo}}" 
                id="cant_sup" 
                @if($tipo_calculo == 'superficie') placeholder="0.00" step="any" @endif
                required
            >
        </div>
        @endif
    </div>

    {{-- @if($proyecto_seleccionado == "casas" || $proyecto_seleccionado == "departamentos")
        @livewire('casas-departamentos')
    @endif --}}
    
    <input  type="hidden" class="" value="{{ $modelo }}" name="modelo" required>

    <div id="formulario" class="row g-3">
    </div>
    <hr class="my-4">
    <button type="submit" class="w-100 btn btn-primary btn-lg" >Calcular</button>

    </form>
</div>