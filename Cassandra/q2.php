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

$fecha = "01/".$v_mes."/".$v_anio;
$fecha = strtotime($fecha)*1000;

// Se arma la consulta
$q = "SELECT lugar, fecha FROM estadistica_mensual WHERE infracciones_placa='$v_placa';";

//var_dump($q);
//exit(0); 
$statement = new Cassandra\SimpleStatement($q);

$result    = $session->execute($statement);
foreach ($result as $row) {
  $date = ($row['fecha'])."";
  $lugar = ($row['lugar'])."";
  settype($lugar, "integer");
  settype($date, "integer");
  echo $date;
  //$v_mes_anio = date('Y/m/d', $fecha);
  echo date('d m Y H:i:s', $date)."</br>";
  //if($v_mes_db == $v_mes and $v_anio_db == $v_anio) {
    //echo "Lugar: ".$lugar." fecha ". $fecha." Velocidad "."</br>";
  //}
  
}
?>