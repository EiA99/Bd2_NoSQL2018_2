<?php

  $placa = htmlspecialchars($_GET["placa"]);
  $fedesde = htmlspecialchars($_GET["fedesde"]);;
  $fehasta = htmlspecialchars($_GET["fehasta"]);;

  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query(array('placa' => $placa));
  $cursor = $manager->executeQuery('pruebaP2.infracciones', $query);

  echo '<table style="width:100%" border="1px"> ';
  foreach ($cursor as $row) {

    $fechaInfraccion = $row->tiempo;
    $dia = date('d', $fechaInfraccion);
    $mes = date('m', $fechaInfraccion);
    $ano = date('Y', $fechaInfraccion);

    //echo 'Fecha: '. $ano . '/' .$mes . '/' .$dia . ' |||||||| ' . $fechaInfraccion;

    $fechaDesde = strtotime($fedesde);
    $fechaHasta = strtotime($fehasta);
    echo ' FechaDesde: '. $fechaDesde . ' FechaInfraccion: '. $fechaInfraccion . " FechaHasta " . $fechaHasta;

    $velocidad = $row->velocidad;

    echo '<th> PLACA </th>';
    echo '<th> FECHA </th>';
    echo '<th> VELOCIDAD </th>';
    echo '<th> LUGAR </th>';

    echo '<tr>';

    if ($velocidad >= 80) {
    //  if ($fechaInfraccion >= $fechaDesde && $fechaInfraccion <= $fechaHasta ) {
        echo '<td>' . $row->placa. "</td>";
        echo '<td>' . $row->velocidad. "</td>";
        echo '<td>' . $row->tiempo. "</td>";
        echo '<td>' . $row->lugar. "</td>";
    //  }
    }

    echo "</tr>";
  }
  echo '</table>';

?>
