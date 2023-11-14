<?php
$cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
$usuario = "root";
$clave = "";
try {
    $db = new PDO($cadena_conexion, $usuario, $clave);
    echo "Conexión realizada con éxito";

    $sql1 = "SELECT * FROM usuarios";
    echo "<br>";

    $usuarios = $db->query($sql1);
    $resultados = $usuarios->fetchAll(PDO::FETCH_ASSOC); 
    echo "<pre>";
    print_r($resultados);
    echo "</pre>";


    foreach ($usuarios as $row) {
       print "Usuario: " . $row["usuario"] . "<br>";
       print "ID: " . $row["id"] . "<br>";
       print "Rol: " . $row["rol"] . "<br>";
       print "Nombre: " . $row["nombre"] . "<br>";
       print "Correo: " . $row["correo"] . "<br>";
       print "<br>";
    }
} catch (PDOException $e) {
    echo "Error conectando a la base de datos: " . $e->getMessage();
}
