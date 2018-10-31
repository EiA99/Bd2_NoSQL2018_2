<?php

echo "Q6 Informacion propietarioo<br>";

$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
$session   = $cluster->connect("fotodeteccion");

// Recupero los argumentos
$v_placa = strtoupper ($_GET['placa']);

// Se arma la consulta
$q = " SELECT cedula, nombre, telefono FROM personas_by_placa WHERE infracciones_placa='$v_placa' and velocidad>80;";

//var_dump($q);
//exit(0); 
$statement = new Cassandra\SimpleStatement($q);

$result    = $session->execute($statement);
foreach ($result as $row) {
  $nombre = $row['nombre']."";
  $cedula = $row['cedula']."";
  $telefono = $row['telefono'];
  settype($telefono, "array");
  settype($nombre, "string");
  settype($cedula, "integer");
  foreach($telefono as $arr){
    echo "Nombre ".$nombre." Cedula ".$cedula." telefono ".$arr."</br>";
  }
  
  
  
}
?>