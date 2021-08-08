<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados | Calculo IMIV Mixto </title>
</head>
<body>
    <div class="container">
        <p>Se ha enviado esta copia del calculo desde el sistema de GYS de lo siguiente:</p>
        <h2>Calculo para:</h2> 
        <ul>
            @foreach($proyecto as $key => $value)
            <li><strong>{{ ucfirst($value) }}</strong> : {{ $texto_datos[$key] }} </li> 
            @endforeach  
        </ul>  
    
        <br> 

        <br><br>
        <div>
            <strong>Periodos</strong><br>
                PM-L = Punta Mañana Laboral <br>
                PMd-L = Punta Medio dia Laboral <br>
                PT-L = Punta Tarde Laboral <br>
                PMd-F = Punta Medio Dia fin de semana <br>
                PT-F = Punta Tarde fin de semana <br>
        </div>
        <br>
        <h4>
        SUMATORIA
        </h4>
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
                    <?php
                    $periodos = array("PM-L", "PMd-L", "PT-L", "PMd-F","PT-F"); 
                    foreach ($sumatoria as $key => $value) { 
                    ?>
                    <tr>
                        <td><?php  echo $periodos[$key]; ?></td>
                        <td><?php  echo $value->transporte_privado;         ?></td>
                        <td><?php  echo $value->transporte_publico;         ?></td>
                        <td><?php  echo $value->peatones_viajes;         ?></td>
                        <td><?php  echo $value->ciclos_viajes;         ?></td>
                        <td><?php echo  $suma_otros[$key]  ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                
                </tbody>
            </table>
        </div>
        <br>
        <h4>Maximo Valor: 
            <span class="badge bg-dark">
                transporte privado
            </span> es: 
            <span class="badge bg-secondary">
                {{ $maximo_t_privado }}
            </span>
        </h4>

        <p>
            Estudio IMIV requerido:  
            <span class="badge bg-primary">
                {{ $estudio_t_privado->imiv }} <br>
            </span>
        </p>
        <p>
            Cantidad Intersecciones:  
            <span class="badge bg-secondary">
                {{ $estudio_t_privado->cruces }}
            </span>
        </p>
        
        <h4>Maximo Valor: 
            <span class="badge bg-dark">
                otros transportes
            </span> es: 
            <span class="badge bg-secondary">
                {{ $maximo_t_otros }}
            </span>
        </h4>

        <p>
            Estudio IMIV requerido: 
            <span class="badge bg-primary">
                {{ $estudio_t_otros->imiv  }}<br>
            </span>
        </p>
        <p>
            Cantidad Intersecciones: 
            <span class="badge bg-secondary">
                {{ $estudio_t_otros->cruces  }}
            </span>
        </p>	
    </div>
</body>
</html>