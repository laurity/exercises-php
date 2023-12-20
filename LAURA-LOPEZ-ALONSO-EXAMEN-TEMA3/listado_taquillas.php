<?php
require "connection.php";
$conexion = conectarBD();

session_start();

$guardarLocalidad = '';
if(isset($_SESSION['localidad'])) {
    $guardarLocalidad = $_SESSION['localidad'];
}

if(isset($_GET['localidad'])) {
    $guardarLocalidad = $_GET['localidad'];
    $_SESSION['localidad'] = $guardarLocalidad;
}

?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Taquillator</title>
</head>

<body>
    <form action="" method="get">
    <select name="localidad">
        <option value="">Todas las localidades</option>
        <option value="Gijón" <?= $guardarLocalidad == 'Gijón' ? 'selected' : ''; ?> >Gijón</option>
        <option value="Oviedo" <?= $guardarLocalidad == 'Oviedo' ? 'selected' : ''; ?>>Oviedo</option>
        <option value="Avilés" <?= $guardarLocalidad == 'Avilés' ? 'selected' : ''; ?>>Avilés</option>
    </select>
        <input type="submit" value="Buscar">
    </form>

</body>

</html>



<?php
if (isset($_GET['localidad'])) {
    
    ////////////////////////////////////////////
    // TODO 2: Obtener taquillas según filtro //
    ////////////////////////////////////////////
        
    $sql = "SELECT * FROM PuntosDeRecogida";
    if($guardarLocalidad !== '') {
        $sql .= " WHERE localidad = ?";
        $resultado = $conexion->prepare($sql);
        $resultado->execute([$guardarLocalidad]);
    } else {
        $resultado = $conexion->query($sql);
    }
    
    if ($resultado->rowCount() > 0) {
        echo "<table>
        <tr>
            <th>Localidad</th>
            <th>Dirección</th>
            <th>Capacidad</th>
            <th>Ocupadas</th>
        </tr>";

        /////////////////////////////////////
        // TODO 3: Imprimir filas de tabla //
        /////////////////////////////////////

        while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            if($row['ocupadas'] !== $row['capacidad']){
                echo "
            <tr>
                <td>" . htmlspecialchars($row["localidad"]) . "</td>
                <td>" . htmlspecialchars($row["direccion"]) . "</td>
                <td>" . htmlspecialchars($row["capacidad"]) . "</td>
                <td>" . htmlspecialchars($row["ocupadas"]) . "</td>
            </tr>";
            }
        }
        echo "</table>";
    } else {
        echo "No hay resultados";
    }
}
?>