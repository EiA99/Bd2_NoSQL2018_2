<?PHP
echo "Q4: Dada una fecha Y lugar se puede consultar las horas del día, vehículo(placas) Y velocidad" . "<br>";

/*Se recuperan los argumentos*/
$fechaI_TSP = strtotime (($_GET["fecha"]));
$fechaF_TSP = $fechaI_TSP + 86400;
$lugar = ($_GET["lugar"]);

/*Argumentos*/

/*Lugar Escogido*/
echo  "<br> Lugar Escogido: " . $lugar . "<br>";

/*Fecha formateada*/
echo "Hora inicio: " . gmdate("H:i:s  Y-m-d", $fechaI_TSP) . "<br>";
echo "Hora fin: " . gmdate("H:i:s  Y-m-d", $fechaF_TSP) . "<br";
echo "<br>";


/*Crear conexion (Puerto, Usuario, Clave y base datos)*/
$conn = new mysqli('localhost:3306', 'root', '','mydb');

/*Realizar consulta*/
$query = "SELECT Fecha, Placa, Velocidad  
          FROM infracciones
          WHERE IdLugar = $lugar
            AND Fecha > $fechaI_TSP
            AND Fecha < $fechaF_TSP 
          ORDER BY Fecha ASC ";
          
          
if ($result = mysqli_query($conn, $query)) {

    
    echo "<br> <br> Cantidad de filas: " . $lenght = mysqli_num_rows ($result) . "<br> <br>";

    /*Mostrar resultado de la consulta*/
    while ($row = mysqli_fetch_assoc($result)) { 
        printf ("Fecha: %s \n (Placa: %s) \n velocidad: %s <br>", gmdate("H:i:s  Y-m-d", $row["Fecha"]), $row["Placa"], $row["Velocidad"]);
    }

}

/* cerrar la conexión */
mysqli_close($conn);
?>
