<?php

echo "Q3 Infracciones por cedula<br>";

$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
$session   = $cluster->connect("fotodeteccion");

// Recupero los argumentos
$v_fecha = $_GET['fecha'];
$v_lugar = $_GET['lugar'];
$v_fecha = strtotime($v_fecha);
// Se arma la consulta
$q = "SELECT fecha, infracciones_placa, velocidad FROM infracciones_by_lugar WHERE lugar=$v_lugar and fecha=$v_fecha;";

//var_dump($q);
//exit(0); 
$statement = new Cassandra\SimpleStatement($q);

$result    = $session->execute($statement);
foreach ($result as $row) {
  $velocidad = ($row['velocidad'])."";
  $fecha = ($row['fecha'])."";
  $placa = ($row['infracciones_placa'])."";
  settype($fecha, "integer");
  
  echo "Fecha y Hora: ".date('d/m/Y H:i:s', $fecha)." Lugar ".$lugar." Velocidad ".$velocidad." Placa: ".$placa."</br>";
  
  
}
?>