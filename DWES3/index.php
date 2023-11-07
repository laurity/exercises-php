<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWES Tema 3</title>
</head>
<body>
    <p>
        <?php
        //comunicarnos con el servidor
        //Get envia y post envia informacion
        if(is_null ($_GET["nombre"])){
            echo "nombre es null<br>";
        }
        else{
            echo "nombre no es null<br>";
        }

        if (empty ($_GET["nombre"])){
            echo "está vacío <br>";
        }
        else{
            
        }
        /*
        empty();
        is_null();
            echo $_SERVER['REQUEST_METHOD']; 
            echo "<br>";
           // echo $_GET ["nombre"];
           print_r($_GET); //Te dice los contenidos del metodo GET
           echo "<br>";

           echo "Hola " . $_GET["nombre"];
           echo "<br>";
           $edad = $_GET["edad"];
           echo "Tiene " . $edad . " años" . "<br>";
           echo "<br>";

           echo $_GET["direccion"];*/
        ?>
    </p>
    
</body>
</html>