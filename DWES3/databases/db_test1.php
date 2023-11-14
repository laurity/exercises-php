<?php
    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
    $usuario = "root";
    $clave="";
    try {
        $db = new PDO($cadena_conexion, $usuario, $clave);
        echo "Conexión realizada con éxito";

        $sql1 = "SELECT usuario FROM usuarios";
        echo "<br>";

        $usuarios = $db->query($sql1);

        foreach ($usuarios as $row) {
            print $row["usuario"]. "<br>";
            print_r($row);
        }
        print_r($usuarios) ;

    } catch (PDOException $e) {
        echo "Error conectando a la base de datos: ".$e->getMessage();   
    }
?>