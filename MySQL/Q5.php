<?PHP
echo 'Q5: Dado una fecha se puede consultar los vehículos(placas) que sobrepasaron 80km, listando hora del día, lugar Y placa. <br> <br>'; 

/*Se recuperan los argumentos*/
$fechaI_TSP = strtotime(($_GET["fecha"]));
$fechaF_TSP = $fechaI_TSP + 86400;

/*Argumentos*/

/*Fecha formateada*/
echo "Hora inicio: " . gmdate("H:i:s  Y-m-d", $fechaI_TSP) . "<br>";
echo "Hora fin: " . gmdate("H:i:s  Y-m-d", $fechaF_TSP) . "<br";
echo "<br>";

/*Crear conexion (Puerto, Usuario, Clave y base datos)*/
$conn = new mysqli('localhost:3306', 'root', '','mydb');

/*Realizar consulta*/
$query = "SELECT Fecha, IdLugar, Placa  
          FROM infracciones
          WHERE Velocidad > 80
            AND Fecha > $fechaI_TSP
            AND Fecha < $fechaF_TSP
          ORDER BY Fecha ASC ";
          
          
if ($result = mysqli_query($conn, $query)) {

    
    echo "<br> <br> Cantidad de filas: " . $lenght = mysqli_num_rows ($result) . "<br> <br>";

    /*Mostrar resultado de la consulta*/
    while ($row = mysqli_fetch_assoc($result)) { 
        printf ("Fecha: %s \n Lugar: %s \n (Placa: ) %s <br>", gmdate("H:i:s  Y-m-d", $row["Fecha"]), $row["IdLugar"], $row["Placa"]);
    }

}

/* cerrar la conexión */
mysqli_close($conn);
?>


