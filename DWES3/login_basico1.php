<?php
    if($_POST ["usuario"] == "pepe" and $_POST["clave"] == "1234"){
        header("Location:bienvenido.html");
    }
    else{
        header ("Location:error.html");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWES Tema 3</title>
</head>
<body>
   <?php
    echo "Usuario introducido " . $_POST["usuario"]."<br>";
    echo "Clave introducida " . $_POST["clave"]."<br>";

    print_r($_POST);
    echo "<br>";
    var_dump($_POST);
    //print_r ($_SERVER['REQUEST_METHOD']);
    //print_r ($_GET);
   ?>
    
</body>
</html>