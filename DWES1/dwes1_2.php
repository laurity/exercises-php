<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World!</title>
</head>

<body>
    <h1>
        <?php
        echo "Hello world!";
        ?>
    </h1>
    <p>
        <?php
        $saludo = "Bienvenido";
        $nombre = "Pepe";
        echo $saludo . ", " . $nombre;
        ?>
    </p>
    <p>
        <?php
        if (print "Hola") {
            echo ", ¿que tal?.";
        }
        ?>
    </p>
    <p>
        <?php
        $miEntero1 = 15;
        $miEntero2 = 015;
        $miEntero3 = 0 * 15;
        echo "entero 1 +2 = " . $miEntero1 + $miEntero2 . "<br>";
        echo "entero 2 = " . $miEntero2 . "<br>";
        echo "entero 3 = " . $miEntero3;
        ?>
    </p>
    <p>
        <?php
        $a = 5;
        // $b = $a+1;
        $b = $a++;
        $c = ++$a;

        echo "a = " . $a . "<br>";
        echo "b = " . $b . "<br>";
        echo "c = " . $c . "<br>";
        echo "c = " . "incremento " . ++$c . "<br>";
        echo " a = " . $a . "<br>";
        ?>
    </p>
    <p>
        <?php
        $a = $b = "3.1416";
        //recuerda \ la barra pa cuando quieras poner el dolar.
        echo "a = vale $a\$ y es de tipo = " . gettype($a);
        settype($b, "float");
        echo "<br> b vale $b y es de tipo = " . gettype($b);
        ?>

    <?php
    function filtrarAutor($libros3, $autor)
    {
        $librosFiltrados = [];
        foreach ($libros3 as $book) {
            if ($book["autor"] === $autor) {
                $librosFiltrados[] = $book;
            }
        }
        return $librosFiltrados;
    }
    function filtrarFecha($libros3, $fecha)
    {
        $fechasFiltradas = [];
        foreach ($libros3 as $book) {
            if ($book["fecha"] < '2000') {
                $fechasFiltradas[] = $book;
            }
        }
        return $fechasFiltradas;
    }

    ?>
    <h1>Filtramos por funcion</h1>
    <?php

function filtro ($items, $fn) {
    $filteredItems = [];
        foreach ($items as $item) {
            if ($fn($item)) {
                $filteredItems[] = $item;
            }
        }
        return $filteredItems;     
    };
    
   /* $nuevaLista = filtro($libros3, function($book) {
     return $book['autor'] === 'JK Rowling';
    });*/


    ?>
    <ul>
        <?php
        foreach ($libros as $book) {
            echo "<li>$book</li>";
        }
        echo "<br> NOMBRE:";
        foreach ($libros3 as $book) {
            echo "<li>$book[titulo]</li>";
        }
        echo "<br> AUTORES:";
        foreach ($libros3 as $book) {
            echo "<li>$book[autor]</li>";
        }
        echo "<br> URL:";
        foreach ($libros3 as $book) {
            echo "<li>$book[url]</li>";
        }
        echo "<br>";
        echo "Fecha:";
        foreach ($libros3 as $book) {
            echo "<li>$book[fecha]</li>";
        }
        echo "<br>";
        ?>
        <?php foreach ($libros3 as $book) : ?>
            <li>
                <?php echo $book['titulo'] ?>
            </li>
        <?php endforeach; ?>
        <br>
        <?php foreach ($libros3 as $book) : ?>
            <li>
                <?php echo $book['autor'] ?>
            </li>
        <?php endforeach; ?>
        <br>
        <?php foreach ($libros3 as $book) : ?>
            <li>
                <a href="<?php echo $book['url'] ?>">
                    <?php echo $book['titulo'] ?>
                </a>
            </li>
            <br>
        <?php endforeach; ?>

        <?php foreach ($libros3 as $book) : ?>
            <?php if ($book['titulo'] == "The Lord Of the Rings") : ?>
                <h2>
                    <?php echo "Filtramos por titulo y fecha con un IF" ?>
                </h2>
                <br>
                <li>
                    <?= $book['titulo'] ?> <?= $book['fecha'] ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        <br>
        <?php foreach (filtrarAutor($libros3, 'JK Rowling') as $book) : ?>

            <h2>
                <?php echo "Filtramos por titulo y fecha  con un METODO" ?>
            </h2>
            <br>
            <li>
                <?= $book['titulo'] ?> <?= $book['fecha'] ?>
            </li>

        <?php endforeach; ?>
        <br>

        <?php foreach (filtrarFecha($libros3, '2000') as $book) : ?>

            <h2>
                <?php echo "Filtramos FECHA con un METODO" ?>
            </h2>
            <br>
            <li>
                <?= $book['titulo'] ?> <?= $book['fecha'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>