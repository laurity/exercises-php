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
                "comprar" => "https://www.google.com/",
                "anio" => "2019",
                "editorial" => "Santander"
            ],
            [
                "titulo" => "The Lord of the Rings",
                "autor" => "AAAAAAA",
                "comprar" => "http://ejemplo.com",
                "anio" => "2023",
                "editorial" => "Planeta"
            ],
            [
                "titulo" => "The Hobbit",
                "autor" => "AAAAAAA",
                "comprar" => "http://ejemplo.com",
                "anio" => "2013",
                "editorial" => "Planeta"
            ],
            [
                "titulo" => "The Dark Tower",
                "autor" => "AAAAAAA",
                "comprar" => "http://ejemplo.com",
                "anio" => "1987",
                "editorial" => "Santillana"
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
        foreach ($libros as $book) { //Recorremos el array y va imprimiendo cada elemento. 
            echo "<li>". $book["titulo"]. "</li>"."<br/>";
        }
        ?>
<!--la sintaxis con el igual es un abreviado de echo-->
        <?php foreach ($libros as $libro) : ?> 
            <li>
            <a href="<?= $libro['comprar']?>">
            <?= $libro['titulo']?></a> 

            </li><br/>

        <?php endforeach; ?>

        <!--Creamos una función que imprima el titulo y autor de cada libro-->
        <?php 
            function filtrarPorAutor ($libros){
                foreach ($libros as $libro) {
                    if ($libro["autor"] == "JK Rowling") {
                        $librosFiltrados[] = $libro;
            }
        }
        return $librosFiltrados;
    }
    var_dump(filtrarPorAutor($libros));
            ?>
        

        <?php foreach ($libros as $book) :?>
    <!--Filtramos por titulo y fecha-->
    <?php if ($book['titulo'] == "Harry Potter") :?>
    <p>
     <?php echo "Filtramos por titulo y fecha"?>
     </p>
     <br>
     <li>
     <?= $book['titulo']?> <?=$book['anio']?>
     </li>

 <?php endif;?>
 <?php endforeach;?>
    </ul>
    </p>

</body>

</html>