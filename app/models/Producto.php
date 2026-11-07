<?php

class Producto
{
    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

    // Obtener todos los productos
    public function obtenerTodos(): array
    {
        $sql = "SELECT
                    p.id_producto,
                    p.nombre,
                    p.precio,
                    p.upc,
                    p.fecha_creacion,
                    p.existencia,
                    p.id_categoria,
                    c.nombre AS categoria
                FROM Producto p
                INNER JOIN Categoria c
                    ON p.id_categoria = c.id_categoria
                ORDER BY p.nombre ASC";

        $consulta = $this->conexion->query($sql);

        return $consulta->fetchAll();
    }

    // Obtener un producto por su ID
    public function obtenerPorId(int $id): ?array
    {
        $sql = "SELECT *
                FROM Producto
                WHERE id_producto = :id";

        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(['id' => $id]);

        $resultado = $consulta->fetch();

        return $resultado ?: null;
    }

    // Registrar un producto
    public function crear(
        int $idCategoria,
        string $nombre,
        float $precio,
        ?string $upc,
        int $existencia
    ): bool {
        $sql = "INSERT INTO Producto
                    (id_categoria, nombre, precio, upc, existencia)
                VALUES
                    (:id_categoria, :nombre, :precio, :upc, :existencia)";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([
            'id_categoria' => $idCategoria,
            'nombre' => $nombre,
            'precio' => $precio,
            'upc' => $upc,
            'existencia' => $existencia
        ]);
    }

    // Actualizar un producto
    public function actualizar(
        int $id,
        int $idCategoria,
        string $nombre,
        float $precio,
        ?string $upc,
        int $existencia
    ): bool {
        $sql = "UPDATE Producto
                SET
                    id_categoria = :id_categoria,
                    nombre = :nombre,
                    precio = :precio,
                    upc = :upc,
                    existencia = :existencia
                WHERE id_producto = :id";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([
            'id_categoria' => $idCategoria,
            'nombre' => $nombre,
            'precio' => $precio,
            'upc' => $upc,
            'existencia' => $existencia,
            'id' => $id
        ]);
    }

    // Eliminar un producto
    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM Producto
                WHERE id_producto = :id";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([
            'id' => $id
        ]);
    }
}