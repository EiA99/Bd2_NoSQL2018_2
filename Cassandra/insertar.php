<?php
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM
	
	Nota: En Archivo donde no hay que contabilizar los tiempos
*/

/*Se recuperan los argumentos
$lugar		= htmlspecialchars($_GET["lugar"]);
$placa		= htmlspecialchars($_GET["placa"]);
$tiempo		= htmlspecialchars($_GET["tiempo"]);
$velocidad	= htmlspecialchars($_GET["velocidad"]);

/*Validación de argumentos

echo 'lugar='. 		$lugar .'</br>';
echo 'placa='. 		$placa .'</br>';
echo 'tiempo='. 	$tiempo .'</br>';
echo 'velocidad='. 	$velocidad;'</br>';


/* ==--> Aqui ustede debe hacer la conexion a la base de datos*/
/*
$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
// Seleccionar la base de datos
$session   = $cluster->connect("fotodeteccion");


/* ==--> Se arma el Batch*/
/*
$q = "BEGIN BATCH	
insert into infraccioness_by_cedula (cedula, velocidad, lugar, fecha, infracciones_placa) values (123, 90, 1, 1541030055000, 'ABC123');
insert into infraccioness_by_cedula (cedula, velocidad, lugar, fecha, infracciones_placa) values (123, 90, 1, 1546300455000, 'ABC123');	
	APPLY BATCH;"; 


/* ==--> insertar el o los registros*/
/*
$statement = new Cassandra\SimpleStatement($q);
$session->execute($statement);
$session->close();*/
/*retornar el texto con resultado*/
echo "OK";
?>