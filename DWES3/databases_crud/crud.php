<?php
    function conectarDB(){
        $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
        $usuario = "root";
        $clave = "";

        try{
            $bd = new PDO($cadena_conexion, $usuario, $clave);
            return $bd;
        } catch(PDOException $e){
            echo "Error al conectar en la base de datos: " . $e->getMessage();
        }
    }

    $conn = conectarDB();

    function listarPizzas($conn){
        $consulta = $conn->prepare("SELECT nombre, precio FROM pizzas");
        $consulta->execute();

        foreach($consulta->fetchAll(PDO::FETCH_ASSOC)as $row){
            echo $row["nombre"]. ". ". $row["precio"] .  "€.<br>";
        }


    }
    echo "<h1>Nuestras Pizzas</h1>";
    listarPizzas($conn);


    //Datos de la nueva pizza
    $nombrePizza = "Pizza prueba";
    $costePizza = 5.00;
    $precioPizza = 10.00;
    $ingredientesPizza = "Tomate, Mozzarela, Albahaca, Jamón, Parmesano";

    $insertar = $conn->prepare("INSERT INTO pizzas (nombre, coste, precio, ingredientes) VALUES 
    (:nombre, :coste, :precio, :ingredientes)");

    $insertar -> bindParam(':nombre', $nombrePizza);
    $insertar -> bindParam(':coste', $costePizza);
    $insertar -> bindParam(':precio', $precioPizza);
    $insertar -> bindParam(':ingredientes', $ingredientesPizza);

    $insertar->execute();

    echo "<h1>Pizzas tras añadir nueva pizza</h1>";
    listarPizzas($conn);
    
    //Pizza modificada
    $nombrePizza = "Pizza modificada";
    $costePizza = 6.00;
    $precioPizza = 11.00;
    $ingredientesPizza = "Tomate, Mozzarela, Albahaca, Champiñones";
    $nombreOriginal = "Pizza prueba";

    $modificar = $conn->prepare("UPDATE pizzas SET nombre = :nombre, coste = :coste, precio = :precio,
    ingredientes = :ingredientes WHERE nombre = :nombreOriginal");

$modificar -> bindParam(':nombre', $nombrePizza);
$modificar -> bindParam(':coste', $costePizza);
$modificar -> bindParam(':precio', $precioPizza);
$modificar -> bindParam(':ingredientes', $ingredientesPizza);
$modificar -> bindParam(':nombreOriginal', $nombreOriginal);

$modificar->execute();
echo "<h1>Pizzas tras modificar</h1>";
listarPizzas($conn);

//Borrar Pizza

$nombreABorrar = "Pizza modificada";

$eliminar = $conn->prepare("DELETE FROM pizzas WHERE nombre = :nombre");

$eliminar->bindParam(":nombre", $nombreABorrar);

$eliminar->execute();
echo "<h1>Pizzas tras borrado</h1>";
listarPizzas($conn);


?>