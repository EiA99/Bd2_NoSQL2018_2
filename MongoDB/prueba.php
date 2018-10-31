<?php

  $cedula = htmlspecialchars($_GET["cedula"]);

  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query(array('cedula' => $cedula));
  $cursor = $manager->executeQuery('pruebaP2.personas', $query);

  // Imprime el resultado
  //print_r($cursor->toArray());
  echo '<table style="width:100%" border="1px"> ';
  foreach ($cursor as $row) {
      //var_dump( $row  );
      echo '<th> CEDULA </th>';
      echo '<th> NOMBRE </th>';
      echo '<th> FIJO </th>';
      echo '<th> CELULAR </th>';
      echo '<tr>';
      // OJO cambiar $row->nombre por una columna de la colección que si exista
      echo '<td>' . $row->cedula. "</td>";
      echo '<td>' . $row->nombre. "</td>";
      if (!empty($row->telefono->fijo)) {
        echo '<td>' . $row->telefono->fijo . "</td>";
      }
      if (!empty($row->telefono->celular)) {
        echo '<td>' . $row->telefono->celular . "</td>";
      }
      //var_dump($row->telefono);
      //echo '<td>' . $row->_id. "</td>";
      echo "</tr>";
  }
  echo '</table>';

?>
