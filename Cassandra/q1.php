<?php

echo "Q1 Infracciones por fecha y vehiculo<br>";

$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
$session   = $cluster->connect("fotodeteccion");

// Recupero los argumentos
$v_placa = strtoupper ($_GET['placa']);
$v_fecha_desde = $_GET['fedesde'];
$v_fecha_hasta = $_GET['fehasta'];

$v_fecha_desde = strtotime($v_fecha_desde) * 1000;
$v_fecha_hasta = strtotime($v_fecha_hasta) * 1000;

// Se arma la consulta
$q = "SELECT fecha, lugar, velocidad FROM infracciones_by_placa WHERE infracciones_placa='$v_placa' and fecha > $v_fecha_desde and fecha < $v_fecha_hasta;";

//var_dump($q);
//exit(0); 
$statement = new Cassandra\SimpleStatement($q);

$result    = $session->execute($statement);
foreach ($result as $row) {
  $fecha = ($row['fecha'])."";
  $velocidad = ($row['velocidad'])."";
  settype($velocidad, "integer");
  settype($fecha, "integer");
  if($velocidad > 80) {
    echo "Fecha y Hora: ".date('d/m/Y H:i:s', $fecha)." Lugar ". $row['lugar']." Velocidad ".$row['velocidad']."</br>";
  }
  
}
?>