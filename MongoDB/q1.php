<?php
  $time_start = microtime(true);

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
    $hora = date('h:i:s', $fechaInfraccion);

    $fechaCompleta = $dia . '/' . $mes . '/' . $ano . '/' . $hora;

    $infraccion = $ano . $mes . $dia;

    $velocidad = $row->velocidad;

    echo '<tr>';

    if ($velocidad > 80) {
      if ($infraccion >= $desde && $infraccion <= $hasta ) {
        echo '<td>' . $row->placa. "</td>";
        echo '<td>' . $row->velocidad. "</td>";
        echo '<td>' . $fechaCompleta. "</td>";
        echo '<td>' . $row->lugar. "</td>";
      }
    }

    echo "</tr>";
  }
  echo '</table>';
  $time_end = microtime(true); // Tiempo Final
  $time = $time_end - $time_start; // Tiempo Consumido
  echo "\n</br></br><h2>Tiempo de ejecución ".$time." segundos</h2>";

?>
