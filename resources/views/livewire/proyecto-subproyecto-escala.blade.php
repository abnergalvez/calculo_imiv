<div>
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
        <div class="col-md-5 ">
            <label for="cant_sup" class="form-label fw-bold">Ingrese {{ $tipo_calculo_label }}</label>
            <input  type="text" class="form-control" name="{{ $tipo_calculo}}" id="cant_sup" required>
        </div>
        @endif
    </div>

    @if($proyecto_seleccionado == "casas" || $proyecto_seleccionado == "departamentos")
        @livewire('casas-departamentos')
    @endif
    
    <input  type="hidden" class="" value="{{ $modelo }}" name="modelo" required>
</div>