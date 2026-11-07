<?php

class Categoria
{
    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

    // Obtener todas las categorías
    public function obtenerTodas(): array
    {
        $sql = "SELECT id_categoria, nombre
                FROM Categoria
                ORDER BY nombre ASC";

        $consulta = $this->conexion->query($sql);

        return $consulta->fetchAll();
    }

    // Obtener una categoría por su ID
    public function obtenerPorId(int $id): ?array
    {
        $sql = "SELECT id_categoria, nombre
                FROM Categoria
                WHERE id_categoria = :id";

        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(['id' => $id]);

        $resultado = $consulta->fetch();

        return $resultado ?: null;
    }

    // Registrar una categoría
    public function crear(string $nombre): bool
    {
        $sql = "INSERT INTO Categoria (nombre)
                VALUES (:nombre)";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([
            'nombre' => $nombre
        ]);
    }

    // Modificar una categoría
    public function actualizar(int $id, string $nombre): bool
    {
        $sql = "UPDATE Categoria
                SET nombre = :nombre
                WHERE id_categoria = :id";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([
            'nombre' => $nombre,
            'id' => $id
        ]);
    }

    // Eliminar una categoría
    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM Categoria
                WHERE id_categoria = :id";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([
            'id' => $id
        ]);
    }
}