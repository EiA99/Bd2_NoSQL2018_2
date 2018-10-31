<?php

echo "Home -  Listado de Generos fotodeteccion<br>";

$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
$session   = $cluster->connect("fotodeteccion");

$statement = new Cassandra\SimpleStatement(
"SELECT fecha, lugar FROM infracciones_by_placa WHERE velocidad>80 and infracciones_placa="BBQ123" and fecha>"27/04/2018" and fecha < NOW();");
$result    = $session->execute($statement);
echo "El resultado contiene " . $result->count() . " filas<br>";
foreach ($result as $row) {
  echo 'fecha:'.$row['fecha'].' Lugar:'.$row['lugar'];    
}
