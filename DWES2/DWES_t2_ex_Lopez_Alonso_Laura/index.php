<?php

/**
 * github: https://github.com/laurity/exercises-php/tree/main/DWES2
 */

include "articulo.php";
include "bebida.php";
include "pizza.php";
// solicitar los archivos "articulo.php", "bebida.php", "pizza.php";

// Inicialización de los artículos
$articulos = [
    new Articulo("Lasagna", 3.50, 7.00, 20),
    new Articulo("Pan de ajo y mozzarella", 2.00, 4.50, 15),
    new Pizza("Pizza Margarita", 4.00, 8.00, 30, ["Tomate", "Mozzarella", "Albahaca"]),
    new Pizza("Pizza Pepperoni", 5.00, 10.00, 25, ["Tomate", "Mozzarella", "Pepperoni"]),
    new Pizza("Pizza Vegetal", 4.50, 9.00, 18, ["Tomate", "Mozzarella", "Verduras Variadas"]),
    new Pizza("Pizza 4 quesos", 5.50, 11.00, 20, ["Mozzarella", "Gorgonzola", "Parmesano", "Fontina"]),
    new Bebida("Refresco", 1.00, 2.00, 50, false),
    new Bebida("Cerveza", 1.50, 3.00, 40, true)
];

// Ejemplo de uso


mostrarMenu($articulos);
mostrarMasVendidos($articulos);
mostrarMasLucrativos($articulos);

function mostrarMenu($articulos)
{

    $pizzas = array_filter($articulos, function ($articulo) {
        return $articulo instanceof Pizza;
    });
    $bebidas = array_filter($articulos, function ($articulo) {
        return $articulo instanceof Bebida;
    });
    $otros = array_filter($articulos, function ($articulo) {
        return !($articulo instanceof Pizza) && !($articulo instanceof Bebida);
    });
    echo "<h1>Nuestro menú</h1>";
    echo "<h2>Pizzas</h2>";
    foreach ($pizzas as $item) {
        echo $item->getNombre();
        echo "<br>";
    }
    echo "<h2>Bebidas</h2>";
    foreach ($bebidas as $item) {
        echo $item->getNombre();
        echo "<br>";
    }
    echo "<h2>Otros</h2>";
    foreach ($otros as $item) {
        echo $item->getNombre();
        echo "<br>";
    }
};

function mostrarMasVendidos($articulos)
{
    usort($articulos, function ($a, $b) {
        return $b->getContador() - $a->getContador();
    });

    echo "<h2>Los más vendidos</h2>";
    for ($cont = 0; $cont < 3; $cont++) {
        echo $articulos[$cont]->getNombre() . " Vendidos: " . $articulos[$cont]->getContador();
        echo "<br>";
    }
};

function mostrarMasLucrativos($articulos)
{
    usort($articulos, function ($a, $b) {
        $sumaDeB = (($b->getPrecio()* $b->getContador())-($b->getCoste()* $b->getContador()));
        $sumaDeA = (($a->getPrecio()* $a->getContador())-($a->getCoste()* $a->getContador()));
        return $sumaDeB - $sumaDeA;
    });
    echo "<h2>¡Los más lucrativos!</h2>";
    foreach ($articulos as $item) {
        $total = (($item->getPrecio()* $item->getContador())-($item->getCoste()* $item->getContador()));
        echo $item->getNombre() . "  - Beneficio: " . $total . "€";
        echo "<br>";
    };
}
include "index.view.php";
