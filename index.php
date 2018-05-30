<?php
    function connectDB(){
        // Connecting the data base
        $servidor = 'localhost';
        $usuario = 'root';
        $clave = '';
        $base_de_datos = 'anime';

        $conexion = mysqli_connect($servidor, $usuario, $clave, $base_de_datos);

        if(!$conexion){
            echo "Connection error: " . mysqli_connect_error();
        }
        return $conexion;
    }

    function disconnectDB($conexion){
        $close = mysqli_close($conexion);
        return $close;
    }

    $sql = "SELECT t1.nombre AS lev1, t2.nombre AS lev2, t3.nombre AS lev3 
    FROM categoria AS t1 
    LEFT JOIN categoria AS t2 ON t2.nodo = t1.id 
    LEFT JOIN categoria AS t3 ON t3.nodo = t2.id 
    WHERE t1.nombre = 'Naruto';";

    function getArraySQL($sql){
        $conexion = connectDB();

        // Setting utf8 data format
        mysqli_set_charset($conexion, "utf8");

        if(!$result = mysqli_query($conexion, $sql)){ 
            die("No data available in table"); 
        }

        $rawdata = array(); 
        $i=0;

        while($row = mysqli_fetch_array($result)){
            $rawdata[$i] = $row;
            $i++;
        }

        // Closing the conexion of database
        disconnectDB($conexion);

        return $rawdata;
    }

    $myArray = getArraySQL($sql);
    echo json_encode($myArray);
?>
