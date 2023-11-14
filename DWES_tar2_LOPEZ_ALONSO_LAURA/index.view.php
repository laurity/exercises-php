<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
</head>

<body>
    <?php
    echo "<h2>Libros antes de ser prestados</h2>";
    echo $biblioteca[0];
    echo "<br>";
    echo $biblioteca[3];

    echo "<h2>Prestamos el libro</h2>";
    echo $biblioteca[0]->prestar();
    echo "<br>";
    echo $biblioteca[0];

    echo "<h2>Prestamos el DVD</h2>";
    echo $biblioteca[3]->prestar();
    echo "<br>";
    echo $biblioteca[3];

    echo "<h2>Intentamos volver a tomar prestado el mismo DVD</h2>";
    echo $biblioteca[3]->prestar();
    echo "<br>";
    echo $biblioteca[3];

    echo "<h2>Devolvemos los materiales</h2>";
    echo $biblioteca[0]->devolver();
    echo "<br>";
    echo $biblioteca[0];
    echo "<br>";
    echo $biblioteca[3]->devolver();
    echo "<br>";
    echo $biblioteca[3];

    echo "<h2>Intentamos devolver material no prestado</h2>";
    echo $biblioteca[2]->devolver();
    echo "<br>";
    echo $biblioteca[2];
    ?>
</body>

</html>