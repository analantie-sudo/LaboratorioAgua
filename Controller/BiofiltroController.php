<?php

declare(strict_types=1);

namespace BiofiltroController;

use Model\Biofiltro;

class BiofiltroController
{
    private Biofiltro $modeloBiofiltro;

    public function __construct()
    {
        $this->modeloBiofiltro = new Biofiltro();
    }

    public function calcularEficiencia(float $antes, float $depois): float
    {
        return $this->modeloBiofiltro->calcularEficiencia($antes, $depois);
    }

    public function compararResultados(array $antes, array $depois): array
    {
        return $this->modeloBiofiltro->comparar($antes, $depois);
    }
}
