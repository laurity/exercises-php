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

    function listarPizzas($conn, $filtrarFiltro = null){
        $sql = "SELECT nombre, precio FROM pizzas";

        if ($filtrarFiltro !== null){
            $sql .= " WHERE precio = :precio";
        }

        $consulta = $conn->prepare($sql);

        if ($filtrarFiltro !== null){
            $consulta->bindParam(':precio', $filtrarFiltro, PDO::PARAM_INT);
        }

        $consulta->execute();

        foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
            echo $row["nombre"] . ". " . $row["precio"] . "€.<br>";
        }
    }

    $filtrarFiltro = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['precio'])){
        $filtrarFiltro = $_POST['precio'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar por Pizza</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="buscar">Busca por precio</label>
        <input type="text" id="buscar" name="precio" placeholder="Busca la Pizza">
        <button type="submit">Buscar</button>
    </form>
    <?php listarPizzas($conn, $filtrarFiltro); ?>
</body>
</html>
