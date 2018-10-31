<?PHP
echo 'Q3: Dada una cedula consultar las infracciones <br>'; 

/*Se recuperan los argumentos*/
$cedula  = ($_GET["cedula"]);

/*Argumentos*/

/*Placa Escogida*/
echo  "<br> Cedula Escogida: " . $cedula . "<br>";

/*Crear conexion (Puerto, Usuario, Clave y base datos)*/
$conn = new mysqli('localhost:3306', 'root', '','mydb');

/*Realizar consulta*/
$query = "SELECT fecha, placa, velocidad, idLugar
          FROM infracciones
          WHERE placa IN( SELECT placa 
		                  FROM vehiculos
		                  WHERE ceduladuenho = $cedula)
          AND velocidad >  80
          ORDER BY fecha ASC";		
 
          
          
if ($result = mysqli_query($conn, $query)) {

    
    echo "<br> <br> Cantidad de filas: " . $lenght = mysqli_num_rows ($result) . "<br> <br>";

    /*Mostrar resultado de la consulta*/
    while ($row = mysqli_fetch_assoc($result)) { 
        printf ("Fecha: %s \n (Placa: %s) \n Velocidad: %u \n Lugar: %u  <br>", gmdate("H:i:s  Y-m-d", $row["fecha"]), $row["placa"], $row["velocidad"], $row["idLugar"]);
    }

}

/* cerrar la conexión */
mysqli_close($conn);
?>