<?php
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:db_text2.php?redirigido=true");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>EL ADMIN HA ENTRADO</h1>
</body>
</html>