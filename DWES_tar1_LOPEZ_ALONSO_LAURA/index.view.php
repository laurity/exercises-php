<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <h1>Ejercicio 1</h1>
    <h2>clientes suscritos</h2>
    <ol>
        <?php
        foreach ($cliente as $clientes) {
            if ($clientes['suscripcion'] == true) {
                echo "<li>{$clientes['nombre']}</li>";
            }
        }
        ?>
    </ol>
    <h2>clientes no suscritos</h2>
    <ol>
        <?php
        foreach ($cliente as $clientes) {
            if ($clientes['suscripcion'] == false) {
                echo "<li>{$clientes['nombre']}</li>";
            }
        }
        ?>
    </ol>
    <h2>clientes que hayan hecho pedidos</h2>
    <ol>
        <?php
        foreach ($cliente as $clientes) {
            if ($clientes['listadoProductos']['precioTotal'] > 0) {
                echo "<li>{$clientes['nombre']} {$clientes['listadoProductos']['precioTotal']}€</li>";
            }
        }
        ?>
    </ol>


    <h1>Ejercicio 2</h1>
    <h2>Clientes que hayan hecho pedidos por orden decreciente</h2>
        <?php
        function filtrar($a, $b)
        {
            return $b['listadoProductos']['precioTotal'] - $a['listadoProductos']['precioTotal'];
        }
        usort($cliente, 'filtrar');
        foreach ($cliente as $clientes) {
            if ($clientes['listadoProductos']['precioTotal'] > 0) {
                echo "Nombre: " . $clientes['nombre'] . ", Precio Total: " . $clientes['listadoProductos']['precioTotal'] . "€" . "<br>";
            }
        }

        ?>
</body>

</html>


function mostrarMasLucrativos($articulos) {
    echo "<h1>¡Los más lucrativos!</h1>";
};
include "index.view.php";

function mostrarMasVendidos($articulos)
{
 
    //Utilizamos la funcion usort para ordenar dentro de articulos los elementos segun el criterio que decidamos, en este caso ordenamos por contador ya que queremos saber los más vendidos, que seran aquellos que tengan el valor del contador mas alto
    usort($articulos, function ($a, $b) {
        return $b->getContador() - $a->getContador();
    });
 
    //Con esto lo que hacemos es sacar los 3 más vendidos, limitando a esas vueltas el bucle for aunque con la funcion usort ordenasemos toda la lista
    echo "<h2>Los más vendidos</h2><br>";
    for ($i = 0; $i < 3; $i++) {
        echo $articulos[$i]->getNombre() . " - Vendidos: " . $articulos[$i]->getContador() . "<br>";
    }
 
    //Con esto saldrian todos ordenados, pero solo queremos los 3 primeros
    // foreach ($articulos as $item) {
    //     echo $item->getNombre() . " - Vendidos:" . $item->getContador() . "<br>";
    // }
}
 
function mostrarMasLucrativos($articulos)
{
 
    //Utilizamos la funcion usort para ordenar dentro de articulos los elementos segun el criterio que decidamos, en este caso ordenamos por beneficio
 
    usort($articulos, function ($a, $b) {
        //Para obtener el beneficio tenemos que multiplicar el precio por el contador y restarle el resultado de multiplicar el coste por el contador, de ese modo restamos la ganancia total del coste total de cada producto y nos queda el beneficio
        $beneficioB = ($b->getPrecio() * $b->getContador()) - ($b->getCoste() * $b->getContador());
        $beneficioA = ($a->getPrecio() * $a->getContador()) - ($a->getCoste() * $a->getContador());
        return $beneficioB - $beneficioA;
    });
 
 
    //Imprimimos por pantalla con el formato que queremos la lista de articulos que ahora esta ordenada segun el beneficio
    echo "<h2>¡Los más lucrativos!</h2>";
    foreach ($articulos as $item) {
        //Hacemos la variable beneficio para no tener que escribir toda la expresion varias veces
        $beneficio = ($item->getPrecio() * $item->getContador()) - ($item->getCoste() * $item->getContador());
        echo $item->getNombre() . " - Beneficio: " . $beneficio . "€<br>";
    }
}