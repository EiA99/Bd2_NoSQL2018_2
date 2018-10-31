<?PHP
echo 'Q2: Dada el año, mes Y el vehículo(placas), se puede consultar las estadísticas de total de pasos por cada lugar. Listando lugar Y número de pasadas (Note que este es un consolidado mensual) <br>';

/*Se recuperan los argumentos*/
$anio = ($_GET["anio"]);
$mes = ($_GET["mes"]);
$placa  = ($_GET["placa"]);

/*Argumentos*/

echo  "<br> Placa Escogida: " . $placa . "<br>";

$fechaI_String = $anio . '/' . $mes . '/01 <br>';
$fechaI_TSP = strtotime($fechaI_String);
$fechaF_TSP = $fechaI_TSP + 2592000;


/*Fecha formateada*/
echo "Hora inicio: " . gmdate("H:i:s  Y-m-d", $fechaI_TSP) . "<br>";
echo "Hora fin: " . gmdate("H:i:s  Y-m-d", $fechaF_TSP) . "<br";
echo "<br>";




?>