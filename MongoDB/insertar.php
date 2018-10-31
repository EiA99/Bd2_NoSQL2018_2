<?php
/*
	Creado por Sergio Alvarez
	Version 1.0 - 2018/10/04
	Tecnicas avanzadas de base de datos - UDEM

	Nota: En Archivo donde no hay que contabilizar los tiempos
*/

/*Se recuperan los argumentos*/
$lugar		= htmlspecialchars($_GET["lugar"]);
$placa		= htmlspecialchars($_GET["placa"]);
$tiempo		= htmlspecialchars($_GET["tiempo"]);
$velocidad	= htmlspecialchars($_GET["velocidad"]);

/*Validación de argumentos*/
/*
echo 'lugar='. 		$lugar .'</br>';
echo 'placa='. 		$placa .'</br>';
echo 'tiempo='. 	$tiempo .'</br>';
echo 'velocidad='. 	$velocidad;'</br>';
*/

/* ==--> Aqui ustede debe hacer la conexion a la base de datos*/

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Armar el JSon Para consultar. Ejemplo de JSON { "nombre":"pepe" }
//$query = new MongoDB\Driver\Query(array('cedula' => $cedula, 'nombre' => $nombre, 'telefono' => array('fijo' => $fijo, 'movil' => $movil)));
$query = new MongoDB\Driver\Query(array());
// Se hace la consulta especificando la base de datos y la coleccion
// OJO CAMBIAR udem.usuarios
$cursor = $manager->executeQuery('pruebaP2.infracciones', $query);

/* ==--> Se arma el Json*/

// Armar el JSon Para insertar

$documento = ['placa' => $placa, 'velocidad' => $velocidad, 'lugar' => $lugar, 'tiempo' => $tiempo];

/* ==--> insertar el o los registros*/

$bulk = new MongoDB\Driver\BulkWrite;
$id_documento = $bulk->insert($documento);
//var_dump($id_documento);
$result = $manager->executeBulkWrite('pruebaP2.infracciones', $bulk);

/*retornar el texto con resultado*/
echo "OK ";

?>
