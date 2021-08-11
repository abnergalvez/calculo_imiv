<div>
    <div class="col-md-12 my-2">
        <hr>
        <button class="col-md-2 btn btn-success" wire:click="add" title="Agregar otro tipo" type="button">
            Agregar <i class="bi bi-plus-circle"></i>
        </button>
    </div>
    <br>
    <span class="col-md-12 row">
        <div class="col-md-1">
            <h4><span class="badge bg-secondary">Tipo 1</span></h4>
        </div>
        <div class="col-md-3 form-floating ">
            <input placeholder="Superficie" type="number" min="1" placeholder="0.00" step="any" class="form-control" name="superficies[]" id="superficie1" required>
            <label class="px-4" for="superficie1">Superficie m<sup>2</sup> </label>
        </div>
        <div class="col-md-3 form-floating ">
            <input placeholder="Cantidad Construida" min="1" type="number" class="form-control" name="cantidades[]" id="cantidad1" required>
            <label class="px-4" for="cantidad1">Cantidad Construida</label>
        </div>
    </span>
    @foreach ($items as $item)
    <span class="col-md-12 row" wire:key="{{ $item }}">
        <div class="col-md-1">
            <h4><span class="badge bg-secondary">Tipo {{ $loop->index+2 }}</span></h4>
        </div>
 
        <div class="col-md-3 form-floating ">
            <input placeholder="Superficie" type="number" min="1" class="form-control" placeholder="0.00" step="any" name="superficies[]" id="superficie{{ $item+2 }}" required>
            <label class="px-4" for="superficie{{ $item+2  }}" >Superficie m<sup>2</sup> </label>
        </div>
        <div class="col-md-3 form-floating " >
            <input placeholder="Cantidad Construida" type="number" min="1" class="form-control" name="cantidades[]" id="cantidad{{ $item+2  }}" required>
            <label class="px-4" for="cantidad{{ $item+2  }}">Cantidad Construida</label>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button wire:click="remove({{ $item }})"  class="btn btn-danger delete" type="button" title="Borrar este tipo">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    </span>
    @endforeach
</div>
