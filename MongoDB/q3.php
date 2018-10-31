<?php

  $time_start = microtime(true);

  $cedula = htmlspecialchars($_GET["cedula"]);

  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query(array('cedula' => $cedula));
  $result = $manager->executeQuery('pruebaP2.vehiculos', $query);

  echo '<table style="width:100%" border="1px"> ';
  echo '<th> PLACA </th>';
  echo '<th> VELOCIDAD </th>';
  echo '<th> FECHA </th>';
  echo '<th> LUGAR </th>';
  foreach ($result as $row) {
    $placa = $row->placa;

    $query2 = new MongoDB\Driver\Query(array('placa' => $placa));
    $cursor = $manager->executeQuery('pruebaP2.infracciones', $query2);

    foreach ($cursor as $row2) {
      $fechaInfraccion = $row2->tiempo;
      $dia = date('d', $fechaInfraccion);
      $mes = date('m', $fechaInfraccion);
      $ano = date('Y', $fechaInfraccion);
      $hora = date('h:i:s', $fechaInfraccion);

      $fechaCompleta = $dia . '/' . $mes . '/' . $ano . '/' . $hora;

      $velocidad = $row2->velocidad;

      echo '<tr>';

      if ($velocidad > 80) {
          echo '<td>' . $row2->placa. "</td>";
          echo '<td>' . $row2->velocidad. "</td>";
          echo '<td>' . $fechaCompleta. "</td>";
          echo '<td>' . $row2->lugar. "</td>";
      }
      echo '</tr>';
    }
  }
  echo '</table>';

  $time_end = microtime(true); // Tiempo Final
  $time = $time_end - $time_start; // Tiempo Consumido
  echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";

?>
