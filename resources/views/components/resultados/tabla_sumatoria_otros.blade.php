<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header " id="flush-headingTwo">
            <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseTwo">
                Suma de Ciclos de Entradas y Salidas  (clic para ver detalles)
            </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
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
                                <th scope="col">Sum. Otros (T.Publico, Peaton, Ciclos) </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $periodos = array("PM-L", "PMd-L", "PT-L", "PMd-F","PT-F");
                            @endphp
            
                            @foreach($attributes['sumatoria'] as $key => $value)
                            <tr>
                                <td>{{ $periodos[$key] }}</td>
                                <td>{{ $value["transporte_privado"] }}</td>
                                <td>{{ $value["transporte_publico"] }}</td>
                                <td>{{ $value["peatones_viajes"] }}</td>
                                <td>{{ $value["ciclos_viajes"] }}</td>
                                <td><?php echo $attributes['suma_otros'][$key]  ?></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>