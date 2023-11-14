<?php
$cliente = [
    [
        "nombre" => "Jesus",
        "listaPedidos" => [

            "listadoArticulos" => [
                "grapas","bolígrafos","papelera",     
                "precioTotal" => 17.5       ],
                    ],
        "suscripcion" => true,
    ],

    [
        "nombre" => "Pedro",
        "listaPedidos" => [
            "listadoArticulos" => [
                "hojas","bolígrafos","tijeras",  
                "precioTotal" => 15.40          ],
                    ],
        "suscripcion" => false,
    ],

    [
        "nombre" => "Maria",
        "listaPedidos" => [
            "listadoArticulos" => [
                "hojas","bolígrafos","chinchetas", 
            "precioTotal" => 12.35           ],
        ],
        "suscripcion" => true,
    ],

    [
        "nombre" => "Jaime",
        "listaPedidos" => [
            "listadoArticulos" => [
                "chinchetas","bolígrafos","tijeras",      
                "precioTotal" => 12      ],
                    ],
        "suscripcion" => false,
    ],

    [
        "nombre" => "Pedro",
        "listaPedidos" => [
            "listadoArticulos" => [
                "chinchetas","lapiz","tijeras", 
                "precioTotal" => 15.45
                       ],
        ],
        "suscripcion" => true,
    ],
];

require "index.view.php";
