<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello world</title>
</head>

<body>
    <h1>
        <?php
        echo "Hello World"
        ?>
    </h1>
    <p>
        <?php
        # Esto es un comentario
        // Una linea de comentario
        /*Esto es un comentario de
            varias lineas*/
        $saludo = "Bienvenido";
        $saludo = "Bienvenido";
        $nombre = "Pepe";
        echo $saludo . ", " . $nombre . ".";
        ?>
    </p>
    <p>
        <?php
        if (print "Hola") {
            echo ", caracola.";
        }
        ?>
    </p>

    <p>
        <?php
        $miEntero1 = 15;
        $miEntero2 = 015;
        $miEntero3 = 0x15;

        echo $miEntero1 . "<br/>"; //Normal
        echo $miEntero2 . "<br/>"; //Octal
        echo $miEntero3 . "<br/>"; //Hexadecimal
        ?>
    </p>

    <p>
        <?php
        $a = 5;
        //$b = $a +1;
        $b = $a++;
        $c = ++$a;

        echo "a = " . $a . "<br/>";
        echo "b = " . $b . "<br/>";
        echo "c = " . $c . "<br/>";

        ?>
    </p>

    <p>
        <?php
        $a = "3.1416";
        echo "a vale $a y es de tipo " . gettype($a) . "<br/>";
        echo "a vale \$a y es de tipo " . gettype($a); //para que no se imprima el valor de $a
        ?>
    </p>

    <p>
        <?php
        $a = $b = "3.1416";
        echo "a vale $a y es de tipo " . gettype($a) . "<br/>";
        settype($b, "float") . "<br/>";
        echo "b vale $b y es de tipo " . gettype($b) . "<br/>";
        ?>
    </p>

    <p>
        <?php
        echo "a vale $a y es de tipo " . gettype($a); //Comprobamos que solo se actualizó en las etiquetas de arriba.
        ?>
    </p>

    <p>
        <?php
        $libros = [
            [
                "titulo" => "Harry Potter",
                "autor" => "JK Rowling",
                "comprar" => "https://www.google.com/"
            ],
            [
                "titulo" => "The Lord of the Rings",
                "autor" => "AAAAAAA",
                "comprar" => "http://ejemplo.com"
            ],
            [
                "titulo" => "The Hobbit",
                "autor" => "AAAAAAA",
                "comprar" => "http://ejemplo.com"
            ],
            [
                "titulo" => "The Dark Tower",
                "autor" => "AAAAAAA",
                "comprar" => "http://ejemplo.com"
            ]
        ];
        var_dump($libros) . "<br>"; //Ver dentro de lo que hay en el array

        $libros2 = [    //Estructura que hay en el array
            0 => 'Harry Potter',
            1 => 'The Lord of the Rings',
            2 => 'The Hobbit',
            3 => 'The Dark Tower'
        ];
        var_dump($libros2);

        ?>
    </p>

    <p>
    <ul>
        <?php
        foreach ($libros as $book) { //Recorremos el array y va imprimiendo cada elemento
            echo "<li>". $book["titulo"]. "</li>"."<br/>";
        }
        ?>
        
        <?php foreach ($libros as $libro) : ?> /
            <li>
            <a href="<?php echo $libro['comprar']?>"><?php echo $libro['titulo'] ?></a> 
            </li><br/>
        <?php endforeach; ?>
    </ul>
    </p>

</body>

</html>