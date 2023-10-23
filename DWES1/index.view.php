<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php foreach ($nuevaLista as $libro) :?>
            <li>
                <a href=<?php $libro['url']; ?>>
                <?= $libro['titulo']; ?> (<?= $libro['fecha'];?>), por <?=
                $libro['autor']?>

        </a>
                    
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>