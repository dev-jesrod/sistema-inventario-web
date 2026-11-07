<?php

class CategoriaController
{
    private Categoria $modelo;

    public function __construct(Categoria $modelo)
    {
        $this->modelo = $modelo;
    }

    // Consultar todas las categorías
    public function listar(): array
    {
        return $this->modelo->obtenerTodas();
    }

    // Consultar una categoría específica
    public function mostrar(int $id): ?array
    {
        return $this->modelo->obtenerPorId($id);
    }

    // Registrar una categoría
    public function registrar(string $nombre): bool
    {
        $nombre = trim($nombre);

        if ($nombre === '') {
            throw new InvalidArgumentException(
                'El nombre de la categoría es obligatorio.'
            );
        }

        return $this->modelo->crear($nombre);
    }

    // Actualizar una categoría
    public function actualizar(int $id, string $nombre): bool
    {
        $nombre = trim($nombre);

        if ($id <= 0) {
            throw new InvalidArgumentException(
                'El identificador de la categoría no es válido.'
            );
        }

        if ($nombre === '') {
            throw new InvalidArgumentException(
                'El nombre de la categoría es obligatorio.'
            );
        }

        return $this->modelo->actualizar($id, $nombre);
    }

    // Eliminar una categoría
    public function eliminar(int $id): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException(
                'El identificador de la categoría no es válido.'
            );
        }

        return $this->modelo->eliminar($id);
    }
}