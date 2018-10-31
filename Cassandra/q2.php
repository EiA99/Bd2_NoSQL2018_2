<?php

echo "Q2: Estadistica mensual<br>";

$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
$session   = $cluster->connect("fotodeteccion");

// Recupero los argumentos
$v_anio = strtoupper ($_GET['anio']);
$v_mes = $_GET['mes'];
$v_placa = $_GET['placa'];

$fecha = "01/".$v_mes."/".$v_anio." 23:59:59";
$fecha = strtotime($fecha)*1000;
echo $fecha;

// Se arma la consulta
$q = "SELECT lugar FROM estadistica_mensual WHERE infracciones_placa=$v_placa;";

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