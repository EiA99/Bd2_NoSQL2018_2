<?php

  $placa = htmlspecialchars($_GET["placa"]);

  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query(array('placa' => $placa));
  $result = $manager->executeQuery('pruebaP2.vehiculos', $query);

  echo '<table style="width:100%" border="1px"> ';
  echo '<th> CEDULA </th>';
  echo '<th> NOMBRE </th>';
  echo '<th> FIJO </th>';
  echo '<th> CELULAR </th>';
  foreach ($result as $row) {
    $cedula = $row->cedula;

    $query2 = new MongoDB\Driver\Query(array('cedula' => $cedula));
    $cursor = $manager->executeQuery('pruebaP2.personas', $query2);

    foreach ($cursor as $row2) {

      echo '<tr>';

      echo '<td>' . $row2->cedula. "</td>";
      echo '<td>' . $row2->nombre. "</td>";
      if (!empty($row2->telefono->fijo)) {
        echo '<td>' . $row2->telefono->fijo . "</td>";
      }
      if (!empty($row2->telefono->celular)) {
        echo '<td>' . $row2->telefono->celular . "</td>";
      }

      echo '</tr>';
    }
  }
  echo '</table>';

?>
