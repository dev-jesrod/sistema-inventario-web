<?php

class Categoria
{
    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerTodas(): array
    {
        $sql = "SELECT id_categoria, nombre
                FROM Categoria
                ORDER BY nombre ASC";

        $consulta = $this->conexion->query($sql);

        return $consulta->fetchAll();
    }
}