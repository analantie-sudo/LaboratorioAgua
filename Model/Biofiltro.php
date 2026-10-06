<?php

declare(strict_types=1);

namespace Model;

use InvalidArgumentException;

class Biofiltro
{
    public static function calcularEficiencia(float $antes, float $depois): float
    {
        if (!is_finite($antes) || !is_finite($depois)) {
            throw new InvalidArgumentException('Os valores devem ser números finitos.');
        }

        if ($antes <= 0) {
            throw new InvalidArgumentException('O valor inicial deve ser maior que zero.');
        }

        if ($depois < 0) {
            throw new InvalidArgumentException('O valor final não pode ser negativo.');
        }

        return (($antes - $depois) / $antes) * 100;
    }

    public static function comparar(array $antes, array $depois): array
    {
        $resultado = [];

        foreach ($antes as $parametro => $valorAntes) {
            if (!array_key_exists($parametro, $depois)) {
                continue;
            }

            $valorDepois = (float) $depois[$parametro];
            $valorAntes = (float) $valorAntes;

            if ($valorAntes <= 0) {
                $resultado[$parametro] = ['antes' => $valorAntes,'depois' => $valorDepois,'eficiencia' => null,'mensagem' => 'Não foi possível calcular a eficiência com valor inicial zero ou negativo.',];
                continue;
            }

            $eficiencia = self::calcularEficiencia($valorAntes, $valorDepois);
            $resultado[$parametro] = ['antes' => $valorAntes,'depois' => $valorDepois,'eficiencia' => $eficiencia,'mensagem' => $eficiencia >= 0 ? 'Houve redução do parâmetro.' : 'O valor aumentou após o tratamento.',];
        }

        return $resultado;
    }
}
