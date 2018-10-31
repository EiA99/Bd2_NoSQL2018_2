<?php

  $ano = htmlspecialchars($_GET["anio"]);
  $mes = htmlspecialchars($_GET["mes"]);;
  $placa = htmlspecialchars($_GET["placa"]);;

  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query(array('placa' => $placa));
  $cursor = $manager->executeQuery('pruebaP2.infracciones', $query);

  echo '<table style="width:100%" border="1px"> ';
  echo '<h4> Infracciones para el vehículo: ' . $placa . '</h4>';
  echo '<h5> En el año: ' . $ano . ' y mes: ' . $mes .'</h5>';
  echo '<th> VELOCIDAD </th>';
  echo '<th> LUGAR </th>';
  foreach ($cursor as $row) {
    $fechaInfraccion = $row->tiempo;
    $diaInfraccion = date('d', $fechaInfraccion);
    $mesInfraccion = date('m', $fechaInfraccion);
    $anoInfraccion = date('Y', $fechaInfraccion);

    $velocidad = $row->velocidad;

    echo '<tr>';

    if ($velocidad > 80) {
      if ($anoInfraccion == $ano && $mesInfraccion == $mes) {
        echo '<td>' . $row->velocidad. "</td>";
        echo '<td>' . $row->lugar. "</td>";
      }
    }
    echo '</tr>';
  }
  echo '</table>';

?>
