<?php

  $cedula = htmlspecialchars($_GET["cedula"]);

  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query(array('cedula' => $cedula));
  $result = $manager->executeQuery('pruebaP2.vehiculos', $query);

  echo '<table style="width:100%" border="1px"> ';
  echo '<th> PLACA </th>';
  echo '<th> FECHA </th>';
  echo '<th> VELOCIDAD </th>';
  echo '<th> LUGAR </th>';
  foreach ($result as $row) {
    $placa = $row->placa;

    $query2 = new MongoDB\Driver\Query(array('placa' => $placa));
    $cursor = $manager->executeQuery('pruebaP2.infracciones', $query2);

    foreach ($cursor as $row2) {

      $velocidad = $row2->velocidad;

      echo '<tr>';

      if ($velocidad >= 80) {
          echo '<td>' . $row2->placa. "</td>";
          echo '<td>' . $row2->velocidad. "</td>";
          echo '<td>' . $row2->tiempo. "</td>";
          echo '<td>' . $row2->lugar. "</td>";
      }
      echo '</tr>';
    }
  }
  echo '</table>';

?>
