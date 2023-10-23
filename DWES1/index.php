<?php
        $libros = ["Harry Potter", "The Lord Of the Rings", "Do Androids Dream of Electric Sheep"];
        //Esto seria para debugear, te dice el tipo y la longitud de la cadena.
        /* $libros2 = [
            0 => 'Harry Potter',
            1 => "The Lord Of the Rings",
            2 => "Do Androids Dream of Electric Sheep"
        ];*/
        $libros3 = [
            [
                "titulo" => "Harry Potter",
                "autor" => "JK Rowling",
                "url" => "https://www.casadellibro.com/libro-harry-potter-el-libro-de-cocina-oficial/9791259573056/14239353",
                "fecha" => "1997"
            ],
            [
                "titulo" => "The Lord Of the Rings",
                "autor" => "Tolkien",
                "url" => "https://www.casadellibro.com/libro-el-senor-de-los-anillos-ne-ilustrado-por-alan-lee/9788445011119/13022033",
                "fecha" => "1953"
            ],
            [
                "titulo" => "Do Androids Dream of Electric Sheep",
                "autor" => "Philip K, Dick",
                "url" => "https://www.casadellibro.com/libro-do-androids-dream-of-electric-sheep-obl-5-oxford-bookworms-lib-rary/9780194792226/1195289",
                "fecha" => "1968"
            ],
            [
                "titulo" => "El suelo del ruiseñor",
                "autor" => "Lian Hearn",
                "url" => "https://www.casadellibro.com/libro-el-suelo-de-ruisenor-leyendas-de-los-otori-1/9788412286014/12324103",
                "fecha" => "2002"
            ]
        ];

         $nuevaLista = array_filter($libros3, function ($book) {
            return $book['autor'] === 'JK Rowling';
        });

        require "index.view.php";   //importar archivo