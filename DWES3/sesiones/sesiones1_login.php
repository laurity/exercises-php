<?php
    function comprobar_usuario ($nombre,$clave){
        if($nombre == "usuario" and $clave =="1234"){
            $usu["nombre"]= "usuario";
            $usu ["rol"]=0;
            return $usu;
        }elseif( $nombre == "admin"and $clave == "1234"){
 
            $usu["nombre"] = "admin";
            $usu ["rol"]= 1;
 
    }else return FALSE;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usu = comprobar_usuario ($_POST["usuario"], $_POST["clave"]);
    if ($usu == false) {
        $err = TRUE;
    }else{
        session_start();
        $_SESSION["usuario"]= $_POST["usuario"];
        header("Location: sesiones1_principal.php");
    }
} 
    ?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWES Tema 3</title>
</head>
 
<body>
    <?php
    if (isset($err)) {
        echo "<p>Revisa el usuario y la contraseña</p>";
    }
    ?>
    <!---->
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST">
        <!-- <form action="form.php" method="POST"> esto es para cuando autollamamos y que se quede. -->
        <!-- <form action="login_basico1.php" method="POST"> -->
        <label for="">Usuario</label>
        <input type="text" name="usuario" value="<?php if (isset($usuario)) echo $usuario; ?>">
        <label for="">Clave</label>
        <input type="password" name="clave">
        <input type="submit">
        <!-- todo esto lo hacemos para evitar Cross-Site Scripting. -->
    </form>
</body>
 
</html>