<?php

echo "Q1 Infracciones por fecha y vehiculo<br>";

$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
$session   = $cluster->connect("fotodeteccion");

// Recupero los argumentos
$v_fecha = $_GET['fecha'];


// Se arma la consulta
$q = "SELECT fecha, lugar, infracciones_placa FROM infracciones_by_fecha WHERE fecha=$v_fecha and velocidad > 80;";

//var_dump($q);
//exit(0); 
$statement = new Cassandra\SimpleStatement($q);

$result    = $session->execute($statement);
foreach ($result as $row) {
  $fecha = ($row['fecha'])."";
  $placa = ($row['infracciones_placa'])."";
  settype($fecha, "integer");
  if($velocidad > 80) {
    echo "Fecha y Hora: ".date('d/m/Y H:i:s', $fecha)." Lugar ". $row['lugar']." Placa: ".$placa." Velocidad ".$row['velocidad']."</br>";
  }
  
}
?>