<?php

declare(strict_types=1);

namespace Controller;

use Model\Biofiltro;

class ControladorBiofiltro
{
    private Biofiltro $biofiltro;

    public function __construct()
    {
        $this->biofiltro = new Biofiltro();
    }

    public function calcularEficiencia(float $antes, float $depois): float
    {
        return $this->biofiltro->calcularEficiencia($antes, $depois);
    }

    public function compararResultados(array $antes, array $depois): array
    {
        return $this->biofiltro->comparar($antes, $depois);
    }
}
