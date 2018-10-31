<?php

echo "Q3 Infracciones por cedula<br>";

$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
$session   = $cluster->connect("fotodeteccion");

// Recupero los argumentos
$v_cedula = ($_GET['cedula']);

// Se arma la consulta
$q = "SELECT velocidad, lugar, fecha, infracciones_placa FROM infracciones_by_cedula WHERE cedula=$v_cedula and velocidad>80;";

//var_dump($q);
//exit(0); 
$statement = new Cassandra\SimpleStatement($q);

$result    = $session->execute($statement);
foreach ($result as $row) {
  $lugar = ($row['lugar'])."";
  $velocidad = ($row['velocidad'])."";
  $fecha = ($row['fecha'])."";
  $placa = ($row['infracciones_placa'])."";
  settype($fecha, "integer");
  
  echo "Fecha y Hora: ".date('d/m/Y H:i:s', $fecha)." Lugar ".$lugar." Velocidad ".$velocidad." Placa: ".$placa."</br>";
  
  
}
?>