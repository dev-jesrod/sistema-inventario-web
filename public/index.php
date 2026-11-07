<?php

try {

    // 1. Obtener la conexión con MySQL
    $conexion = require __DIR__ . '/../app/config/database.php';

    // 2. Cargar modelos
    require_once __DIR__ . '/../app/models/Categoria.php';
    require_once __DIR__ . '/../app/models/Producto.php';

    // 3. Cargar controladores
    require_once __DIR__ . '/../app/controllers/CategoriaController.php';
    require_once __DIR__ . '/../app/controllers/ProductoController.php';

    // 4. Crear los modelos
    $modeloCategoria = new Categoria($conexion);
    $modeloProducto = new Producto($conexion);

    // 5.Crear controladores
    $controladorCategoria = new CategoriaController( $modeloCategoria);
    $controladorProducto = new ProductoController( $modeloProducto);

    // . Solicitar las categorías al controlador
    $categorias = $controladorCategoria->listar();

    // Solicitar los productos al controlador
    $productos = $controladorProducto->listar();




    // . Mostrar los resultados de Categorias
    echo "<h2>Categorías registradas</h2>";

    foreach ($categorias as $categoria) {

        echo htmlspecialchars(
            $categoria['nombre'],
            ENT_QUOTES,
            'UTF-8'
        );

        echo "<br>";
    }


    // . Mostrar productos
    echo "<h2>Productos registrados</h2>";

    foreach ($productos as $producto) {

        echo "<hr>";

        echo "ID: " . htmlspecialchars((string)$producto['id_producto']) . "<br>";

        echo "Nombre: " . htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8') . "<br>";

        echo "Precio: $" . htmlspecialchars((string)$producto['precio']) . "<br>";

        echo "Existencias: " . htmlspecialchars((string)$producto['existencia']) . "<br>";

        echo "Categoría: " . htmlspecialchars($producto['categoria'], ENT_QUOTES, 'UTF-8') . "<br>";

        echo "UPC: " . htmlspecialchars($producto['upc'] ?? 'No registrado', ENT_QUOTES, 'UTF-8') . "<br>";
    }

} catch (Throwable $e) {

    echo "Ocurrió un error: " . $e->getMessage();

}