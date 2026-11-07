<?php

try {

    $conexion = require __DIR__ . '/../app/config/database.php';

    require_once __DIR__ . '/../app/models/Categoria.php';

    $categoria = new Categoria($conexion);

    $categorias = $categoria->obtenerTodas();

    echo "<h2>Categorías registradas</h2>";

    foreach ($categorias as $item) {
        echo $item['id_categoria'] . " - ";
        echo $item['nombre'] . "<br>";
    }

} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();

}