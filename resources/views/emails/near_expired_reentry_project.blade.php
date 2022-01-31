<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación GyS</title>
    <style>
      * {
        font-family: Verdana;
      }
    </style>
</head>
<body>
    <div>
        <h2>Notificación Sistema GyS Ingenieria</h2>
    </div>
    <hr>
    <p> Estimado {{ $user->name }}, segun los registros del sistema los siguentes proyectos estan por vencer:</p>
    <ul>

        <li>
            <strong>Proyecto :</strong> {{ isset($project->name) ? $project->name : ' - ' }}  -  Codigo ( {{ isset($project->code) ? $project->code : ' - '}}  ) <strong>vence el :</strong> &nbsp; 
            <?php
             if(isset($project->re_entry_date)){
            ?>
            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->re_entry_date)->locale('es_ES')->isoFormat('D MMM YYYY') }}

            <?php
             }
            ?>
        </li>

    </ul>

    <div>
        <p>Favor ingresar a la plataforma y hacer los re-ingresos antes del vencimiento del plazo</p>
        <p>Atte. Sistema GYS</p>
    </div>
</body>
</html>