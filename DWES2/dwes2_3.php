//Crear dos métodos:
//1. Permite dividir la vraiable $num2 entre $num2
//2. Calcula la raiz cuadrada de un $numero

<?php
    function division($num1, $num2){
        if($num2 ==0){
            throw new Exception("No es posible dividir por ".$num2);
    }
    return $num1 / $num2;
}

    function raiz($numero){
        if ($numero == 0){
            throw new Exception("No es posible calcular la raiz de ".$numero);
        }
        return sqrt($numero);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excepciones</title>
</head>
<body>
    <?php
        echo "<h1>Inicio del programa</h1>";
        try{
        echo division(10, 2);
        echo "</br>";
        }catch(Exception $e){
            echo "Ha ocurrido un error: ". $e->getMessage(). "<br/>";
        }finally{
            echo"<br>Siempre se ejecuta el finally";
        }

        try{
            echo division(10, 0);
            echo "</br>";
            }catch(Exception $e){
                echo "<br>Ha ocurrido un error: ". $e->getMessage(). "<br/>";
            }finally{
                echo"<br>Siempre se ejecuta el finally<br>";
            }
            try{
                echo division(20, 4);
                echo "</br>";
                }catch(Exception $e){
                    echo "<br>Ha ocurrido un error: ". $e->getMessage(). "<br/>";
                }finally{
                    echo"<br>Siempre se ejecuta el finally";
                }

    echo "<h1>Ejercicio 2</h1>";
    try{
        echo round(raiz(5),2);
        echo "<br>";
    }
    catch(Exception $e){
        echo "<br>Ha ocurrido un error: ". $e->getMessage(). "<br/>";
    }
    finally{
        echo "<br>Siempre se ejecuta el finally";
    }

    try{
        echo raiz(0);
        echo "<br>";
    }
    catch(Exception $e){
        echo "<br>Ha ocurrido un error: ". $e->getMessage(). "<br/>";
    }
    finally{
        echo "<br>Siempre se ejecuta el finally";
    }
    ?>
</body>
</html>