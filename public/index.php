<?php

try {

    // 1. Obtener la conexión con MySQL
    $conexion = require __DIR__ . '/../app/config/database.php';

    // 2. Cargar el modelo
    require_once __DIR__ . '/../app/models/Categoria.php';

    // 3. Cargar el controlador
    require_once __DIR__ . '/../app/controllers/CategoriaController.php';

    // 4. Crear los objetos
    $modeloCategoria = new Categoria($conexion);

    $controladorCategoria = new CategoriaController( $modeloCategoria);

    // 5. Solicitar las categorías al controlador
    $categorias = $controladorCategoria->listar();

    // 6. Mostrar los resultados
    echo "<h2>Categorías registradas</h2>";

    foreach ($categorias as $categoria) {

        echo htmlspecialchars(
            $categoria['nombre'],
            ENT_QUOTES,
            'UTF-8'
        );

        echo "<br>";
    }

} catch (Throwable $e) {

    echo "Ocurrió un error: " . $e->getMessage();

}