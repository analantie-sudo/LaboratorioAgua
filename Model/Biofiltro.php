<?php

declare(strict_types=1);

namespace Model;

class Biofiltro
{
    public function calcularEficiencia(float $antes, float $depois): float
    {
        if (!is_finite($antes) || !is_finite($depois)) {
            throw new InvalidArgumentException('Os valores devem ser números finitos.');
        }

        if ($antes <= 0) {
            throw new InvalidArgumentException('O valor antes do filtro deve ser maior que zero.');
        }

        if ($depois < 0) {
            throw new InvalidArgumentException('O valor depois do filtro não pode ser negativo.');
        }

        return round((($antes - $depois) / $antes) * 100, 2);
    }

    public function comparar(array $antes, array $depois): array
    {
        $resultado = [];

        foreach ($antes as $parametro => $valorAntes) {
            if (!array_key_exists($parametro, $depois)) {
                throw new InvalidArgumentException("O valor depois do filtro para {$parametro} não foi informado.");
            }

            $valorAntes = (float) $valorAntes;
            $valorDepois = (float) $depois[$parametro];

            $eficiencia = $this->calcularEficiencia($valorAntes, $valorDepois);

            $resultado[$parametro] = ['antes' => $valorAntes,'depois' => $valorDepois,'eficiencia' => $eficiencia,'resultado' => $eficiencia >= 0 ? 'Houve redução do parâmetro.' : 'O valor aumentou após o tratamento.'];
        }

        return $resultado;
    }
}
