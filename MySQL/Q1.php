<?PHP
echo 'Q1: Dada el vehículo(placas) Y rango de fechas, se puede consultar las infracciones (mas de 80km). Listando fecha, hora, lugar'. "<br>";

/*Se recuperan los argumentos*/
$fechaI_TSP = strtotime(($_GET["fedesde"]));
$fechaF_TSP = strtotime(($_GET["fehasta"]));
$placa  = ($_GET["placa"]);

/*Argumentos*/

/*Placa Escogida*/
echo  "<br> Placa Escogida: " . $placa . "<br>";

/*Fecha formateada*/
echo "Hora inicio: " . gmdate("H:i:s  Y-m-d", $fechaI_TSP) . "<br>";
echo "Hora fin: " . gmdate("H:i:s  Y-m-d", $fechaF_TSP) . "<br";
echo "<br>";

/*Crear conexion (Puerto, Usuario, Clave y base datos)*/
$conn = new mysqli('localhost:3306', 'root', '','mydb');

/*Realizar consulta*/
$query = "SELECT Fecha, IdLugar  
          FROM infracciones
          WHERE Placa = '$placa'
            AND Velocidad > 80
            AND Fecha > $fechaI_TSP
            AND Fecha < $fechaF_TSP
          ORDER BY Fecha ASC ";
          
          
if ($result = mysqli_query($conn, $query)) {

    
    echo "<br> <br> Cantidad de filas: " . $lenght = mysqli_num_rows ($result) . "<br> <br>";

    /*Mostrar resultado de la consulta*/
    while ($row = mysqli_fetch_assoc($result)) { 
        printf ("Fecha: %s \n Lugar: %s <br>", gmdate("H:i:s  Y-m-d", $row["Fecha"]), $row["IdLugar"]);
    }

}

/* cerrar la conexión */
mysqli_close($conn);
?>



