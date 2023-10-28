<?php
    $cliente = [
        [
            "nombre" => "Jorge",
            "listadoProductos" => [
                "listadoArticulo" => "",
                "precioTotal" => 0
            ],
            "suscripcion" => true
        ],
        [
            "nombre" => "Jaime",
            "listadoProductos" => [
                "listadoArticulo" => "Lápices", "Carpetas", "Hojas",
                "precioTotal" => 14.25
            ],
            "suscripcion" => true
        ],
        [
            "nombre" => "María",
            "listadoProductos" => [
                "listadoArticulo" => "",
                "precioTotal" => 12.67
            ],
            "suscripcion" => true
        ],
        [
            "nombre" => "Luisa",
            "listadoProductos" => [
                "listadoArticulo" => "Carpetas", "Hojas",
                "precioTotal" => 20.55
            ],
            "suscripcion" => false
        ],
        [
            "nombre" => "Lara",
            "listadoProductos" => [
                "listadoArticulo" => "Hojas",
                "precioTotal" => 2.69
            ],
            "suscripcion" => false
        ]
        ];

    require "index.view.php";
?>