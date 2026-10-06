<?php

declare(strict_types=1);

namespace ControladorBiofiltro;

use Model\Biofiltro;

class ControladorBiofiltro
{
    public static function analisar(array $antes, array $depois): array
    {
        return Biofiltro::comparar($antes, $depois);
    }
}
