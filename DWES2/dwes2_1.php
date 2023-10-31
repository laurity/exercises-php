<?php
function factorial ($n){
    $result = 1;
    for ($i=1; $i <= $n; $i++) { 
        $result *= $i;
    }
    return $result;
}

function factorial_recursivo($n){
    if($n == 0){
        return 1;
    }
    else{
        return $n * factorial_recursivo($n - 1); 
    }	
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo factorial_recursivo (5);
    ?>
</body>
</html>