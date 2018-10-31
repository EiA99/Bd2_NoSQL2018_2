<?php

  $placa = htmlspecialchars($_GET["placa"]);
  $fedesde = htmlspecialchars($_GET["fedesde"]);;
  $fehasta = htmlspecialchars($_GET["fehasta"]);;

  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query(array('placa' => $placa));
  $cursor = $manager->executeQuery('pruebaP2.infracciones', $query);

  $fechaDesde = explode("/", $fedesde);
  $desde = $fechaDesde[0] . $fechaDesde[1] . $fechaDesde[2];

  $fechaHasta = explode("/", $fehasta);
  $hasta = $fechaHasta[0] . $fechaHasta[1] . $fechaHasta[2];



  /*$fechaDesde = strtotime($fedesde);
  $fechaHasta = strtotime($fehasta);
  echo(strtotime('2018/31/01'));
  echo ' FechaDesde: '. $fechaDesde . '</br> FechaHasta: ' . $fechaHasta;*/

  echo '<table style="width:100%" border="1px"> ';
  echo '<th> PLACA </th>';
  echo '<th> FECHA </th>';
  echo '<th> VELOCIDAD </th>';
  echo '<th> LUGAR </th>';
  foreach ($cursor as $row) {

    $fechaInfraccion = $row->tiempo;
    $dia = date('d', $fechaInfraccion);
    $mes = date('m', $fechaInfraccion);
    $ano = date('Y', $fechaInfraccion);
    //$hora = date('h:i:s', $fechaInfraccion);

    $infraccion = $ano . $mes . $dia;

    echo 'Fecha desde: ' . $desde . '<br> Fecha Infraccion: ' . $infraccion . '<br> Fecha Hasta: ' . $hasta;

    $velocidad = $row->velocidad;

    echo '<tr>';

    if ($velocidad >= 80) {
      if ($infraccion >= $desde && $infraccion <= $hasta ) {
        echo '<td>' . $row->placa. "</td>";
        echo '<td>' . $row->velocidad. "</td>";
        echo '<td>' . $row->tiempo. "</td>";
        echo '<td>' . $row->lugar. "</td>";
      }
    }

    echo "</tr>";
  }
  echo '</table>';

?>
