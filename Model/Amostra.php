<?php

declare(strict_types=1);

namespace Model;

use InvalidArgumentException;

class Amostra
{
    public static function validar(array $dados): void
    {
        if (empty(trim((string) ($dados['nome'] ?? '')))) {
            throw new InvalidArgumentException('O nome da amostra é obrigatório.');
        }

        if (empty($dados['data_coleta'])) {
            throw new InvalidArgumentException('A data da coleta é obrigatória.');
        }
    }

    public static function criar(array $dados): array
    {
        self::validar($dados);

        return ['nome' => trim((string) $dados['nome']), 'data_coleta' => (string) $dados['data_coleta'], 'observacoes' => trim((string) ($dados['observacoes'] ?? '')), 'parametros' => $dados['parametros'] ?? [],];
    }
}
