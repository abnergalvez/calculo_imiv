<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingTwo">
        <button class="accordion-button bg-dark text-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseTwo">
        SUMATORIA  (clic para ver detalles)
        </button>
      </h2>
      <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
    
              <br>
              <x-resultados.periodos />
              <br>
      <div class="row g-3">
    
          <table class="table table-hover table-sm">
            <thead>
              <tr> 
                <th scope="col">Periodos</th>
                <th scope="col">Totales </th>
                <th scope="col">Autos </th>
                <th scope="col">T. Publico </th>
                <th scope="col">Peatones </th>
                <th scope="col">Ciclos </th>
              </tr>
            </thead>
            <tbody>
              <?php
               $periodos = array("PM-L", "PMd-L", "PT-L", "PMd-F","PT-F"); 
               foreach ($attributes['sumatoria'] as $key => $value) { 
              ?>
              <tr>
                <td><?php  echo $periodos[$key]; ?></td>
                <td><?php  echo $value["viajes_h_por_vivienda"];  ?></td>
                <td><?php  echo $value["transporte_privado"];         ?></td>
                <td><?php  echo $value["transporte_publico"];         ?></td>
                <td><?php  echo $value["peatones_viajes"];         ?></td>
                <td><?php  echo $value["ciclos_viajes"];         ?></td>
              </tr>
              <?php
               }
              ?>
              
            </tbody>
          </table>
      </div>
    
    
        </div>
      </div>
    </div>
    
    
    
    </div>