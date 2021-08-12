<div class="accordion accordion-flush" id="accordionFlushEntradas">
    <div class="accordion-item">
        <h2 class="accordion-header " id="flush-headingTwo">
            <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEntradas" aria-expanded="false" aria-controls="flush-collapseTwo">
                ENTRADAS  (clic para ver detalles)
            </button>
        </h2>
        <div id="flush-collapseEntradas" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushEntradas">
            <div class="accordion-body">
                <div class="row g-3">
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
            
                            @foreach($attributes['entradas'] as $key => $value)
                            <tr>
                                <td>{{ $periodos[$key] }}</td>
                                <td>{{ round($value["transporte_privado"],2) }}</td>
                                <td>{{ round($value["transporte_publico"],2) }}</td>
                                <td>{{ round($value["peatones_viajes"],2) }}</td>
                                <td>{{ round($value["ciclos_viajes"],2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>