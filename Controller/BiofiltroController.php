<?php

namespace Controller;

use Model\Biofiltro;
use InvalidArgumentException;

class BiofiltroController
{
    private Biofiltro $biofiltro;

    public function __construct()
    {
        $this->biofiltro = new Biofiltro();
    }

    public function calculate(float $before, float $after): float
    {
        return $this->biofiltro->removalRate($before, $after);
    }

    public function apply(float $value, float $percentage): float
    {
        return $this->biofiltro->apply($value, $percentage);
    }

    public function validatePercentage(float $percentage): ?string
    {
        if ($percentage < 0 || $percentage > 100) {
            return 'A porcentagem deve estar entre 0 e 100.';
        }

        return null;
    }
}