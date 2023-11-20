<?php
//Nos conectamos a la base de datos
function conectarDB(){
    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
    $usuario = "root";
    $clave = "";
//Objeto de datos
    try{
        $db = new PDO($cadena_conexion, $usuario, $clave);
        return $db;
    } catch (PDOException $e){
        echo "Error conectando a la bd: " .$e->getMessage();
    }
}

function comprobar_usuario($nombre, $clave) {
    $conn = conectarDB();   //Guardamos aqui la conexion
    $consulta = $conn->query("SELECT usuario, rol FROM usuarios WHERE usuario = '$nombre' AND clave = '$clave'"); 
    // $consulta = $conn->prepare("SELECT usuario, rol FROM usuarios WHERE usuario = 
    // $nombre AND clave = $clave");
    // $consulta->execute();

    if($consulta->rowCount() > 0){
        $row = $consulta->fetch(PDO::FETCH_ASSOC);
        return array("nombre" => $row["usuario"], "role" => $row["rol"]);
    }else {
        return FALSE;
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usu = comprobar_usuario ($_POST["usuario"], $_POST["clave"]);
    if ($usu == false) {
        $err = TRUE;}
    
    else{
        session_start();
        $_SESSION["usuario"]= $_POST["usuario"] ;
        if ($_SESSION["usuario"]= $_POST["usuario"]=='admin' ){
            header("Location: admin_welcome.php");
        }
        else {
            header("Location: sesiones1_principal.php");
        }
                
    }
} 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="">
        <label for="usuario">Nombre de Usuario:</label>
        <input type="text" name="usuario" required>
        <br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" required>
        <br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
