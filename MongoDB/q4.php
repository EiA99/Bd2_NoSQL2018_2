<?php

  $time_start = microtime(true);

  $lugar = htmlspecialchars($_GET["lugar"]);
  $fechaConsulta = htmlspecialchars($_GET["fecha"]);;

  $division = explode("/", $fechaConsulta);
  $fechaDia = $division[2];
  $fechaMes = $division[1];
  $fechaAno = $division[0];

  $fecha = strtotime($fechaConsulta);
  $fecha2 = strtotime($fechaConsulta) + 86399;

  $filter = [
    'lugar' => $lugar,
    'tiempo' => ['$gte' => $fecha],
    'tiempo' => ['$lte' => $fecha2]
  ];

  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $manager->executeQuery('pruebaP2.infracciones', $query);

  echo '<table style="width:100%" border="1px"> ';
  echo '<th> PLACA </th>';
  echo '<th> VELOCIDAD </th>';
  echo '<th> HORA </th>';
  foreach ($cursor as $row) {

    $fechaInfraccion = $row->tiempo;
    $dia = date('d', $fechaInfraccion);
    $mes = date('m', $fechaInfraccion);
    $ano = date('Y', $fechaInfraccion);
    $hora = date('h:i:s', $fechaInfraccion);

    $velocidad = $row->velocidad;

    echo '<tr>';

    if ($mes == $fechaMes && $ano == $fechaAno && $dia == $fechaDia) {
      echo '<td>' . $row->placa . "</td>";
      echo '<td>' . $row->velocidad . "</td>";
      echo '<td>' . $hora . "</td>";
    }

    echo "</tr>";
  }
  echo '</table>';

  $time_end = microtime(true); // Tiempo Final
  $time = $time_end - $time_start; // Tiempo Consumido
  echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";

?>
