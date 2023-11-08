
<?php
if(!isset($_COOKIE["visitas"])){
    $visitas = 1;
}
else{
    $visitas = $_COOKIE["visitas"];
    $visitas++;
}
    setcookie("visitas",$visitas,time() +3600*24,"/");
    echo "Numero de visitas: " . $_COOKIE["visitas"];
    echo "<br>";
    print_r($_COOKIE);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de visitas</title>
</head>
<body>
    <h1>Bienvenido</h1>

</body>
</html>