<?php

class ProductoController
{
    private Producto $modelo;

    public function __construct(Producto $modelo)
    {
        $this->modelo = $modelo;
    }

    // Consultar todos los productos
    public function listar(): array
    {
        return $this->modelo->obtenerTodos();
    }

    // Consultar un producto por ID
    public function mostrar(int $id): ?array
    {
        if ($id <= 0) {
            throw new InvalidArgumentException(
                'El identificador del producto no es válido.'
            );
        }

        return $this->modelo->obtenerPorId($id);
    }

    // Registrar un producto
    public function registrar(
        int $idCategoria,
        string $nombre,
        float $precio,
        ?string $upc,
        int $existencia
    ): bool {
        $nombre = trim($nombre);
        $upc = $upc !== null ? trim($upc) : null;

        if ($nombre === '') {
            throw new InvalidArgumentException(
                'El nombre del producto es obligatorio.'
            );
        }

        if ($idCategoria <= 0) {
            throw new InvalidArgumentException(
                'Debes seleccionar una categoría válida.'
            );
        }

        if ($precio <= 0) {
            throw new InvalidArgumentException(
                'El precio debe ser mayor que cero.'
            );
        }

        if ($existencia < 0) {
            throw new InvalidArgumentException(
                'Las existencias no pueden ser negativas.'
            );
        }

        if ($upc === '') {
            $upc = null;
        }

        return $this->modelo->crear(
            $idCategoria,
            $nombre,
            $precio,
            $upc,
            $existencia
        );
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
        if ($id <= 0) {
            throw new InvalidArgumentException(
                'El identificador del producto no es válido.'
            );
        }

        $nombre = trim($nombre);
        $upc = $upc !== null ? trim($upc) : null;

        if ($nombre === '') {
            throw new InvalidArgumentException(
                'El nombre del producto es obligatorio.'
            );
        }

        if ($idCategoria <= 0) {
            throw new InvalidArgumentException(
                'Debes seleccionar una categoría válida.'
            );
        }

        if ($precio <= 0) {
            throw new InvalidArgumentException(
                'El precio debe ser mayor que cero.'
            );
        }

        if ($existencia < 0) {
            throw new InvalidArgumentException(
                'Las existencias no pueden ser negativas.'
            );
        }

        if ($upc === '') {
            $upc = null;
        }

        return $this->modelo->actualizar(
            $id,
            $idCategoria,
            $nombre,
            $precio,
            $upc,
            $existencia
        );
    }

    // Eliminar un producto
    public function eliminar(int $id): bool
    {
        if ($id <= 0) {
            throw new InvalidArgumentException(
                'El identificador del producto no es válido.'
            );
        }

        return $this->modelo->eliminar($id);
    }
}