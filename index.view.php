<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 1</title>
</head>

<body>
    <h1>EJERCICIO 1</h1>

    <ol>
        <h2>Gente suscrita</h2>
        <?php foreach ($cliente as $name) : ?>

            <?php if ($name["suscripcion"] == true) : ?>
                <li>
                    <?php echo $name["nombre"]; ?>
                </li>
            <?php endif; ?>

        <?php endforeach; ?>
    </ol>

    <ol>
        <h2>Gente no suscrita</h2>
        <?php foreach ($cliente as $name) : ?>

            <?php if ($name["suscripcion"] == false) : ?>
                <li>
                    <?php echo $name["nombre"]; ?>
                </li>
            <?php endif; ?>

        <?php endforeach; ?>
    </ol>
    <ol>
        <h2>Gente que han hecho un pedido y su gasto total</h2>
        <?php foreach ($cliente as $name) : ?>

            <?php if ($name['listaPedidos']["listadoArticulos"]["precioTotal"] > 0) : ?>
                <?php echo $name["nombre"]; ?>
                <?php echo $name['listaPedidos']["listadoArticulos"]["precioTotal"]."€"; ?>
                <br/>
                <?php endif; ?>
        <?php endforeach; ?>
    </ol>

    <h1>EJERCICIO 2</h1>
    <ol>
        <?php
             foreach ($cliente as $clientes){
                $importeTotal = 0;
                foreach ($clientes["listaPedidos"]["listadoArticulos"] as $articulos) {
                    $importeTotal =+ $articulos["precioTotal"];
                }
            
            }

            $ordenar[$importeTotal] = $cliente;
            arsort($ordenar);

            foreach ($ordenar as $imprimir) {
                echo "<p>Cliente: " . $imprimir["nombre"] . ", importe total gastado: " . $imprimir["listaPedidos"]["listadoArticulos"]["precioTotal"] . "</p>";
            }
            ?>
    </ol>
</body>

</html>