<?php

  $lugar = htmlspecialchars($_GET["lugar"]);
  $fechaConsulta = htmlspecialchars($_GET["fecha"]);;

  $division = explode("/", $fechaConsulta);
  $fechaDia = $division[2];
  $fechaMes = $division[1];
  $fechaAno = $division[0];

  foreach ($division as $k) {
    echo $k;
  }

  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query(array('lugar' => $lugar));
  $cursor = $manager->executeQuery('pruebaP2.infracciones', $query);

  echo '<table style="width:100%" border="1px"> ';
  echo '<th> PLACA </th>';
  echo '<th> VELOCIDAD </th>';
  echo '<th> FECHA </th>';
  foreach ($cursor as $row) {

    $fechaInfraccion = $row->tiempo;
    echo '<br>' . $fechaInfraccion;
    $dia = date('d', $fechaInfraccion);
    $mes = date('m', $fechaInfraccion);
    $ano = date('Y', $fechaInfraccion);
    $hora = date('h:i:s', $fechaInfraccion);

    echo "<br>" . $ano . $mes . $dia;

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


?>
