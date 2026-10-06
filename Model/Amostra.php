<?php

declare(strict_types=1);

namespace Model;

class Amostra
{
    public function criar(array $dados): array
    {
        $nome = trim((string) ($dados['nome'] ?? ''));
        $dataColeta = trim((string) ($dados['data_coleta'] ?? ''));

        if ($nome === '') {
            throw new InvalidArgumentException('O nome da amostra é obrigatório.');
        }

        if ($dataColeta === '') {
            throw new InvalidArgumentException('A data da coleta é obrigatória.');
        }

        return ['nome' => $nome,'data_coleta' => $dataColeta,'observacoes' => trim((string) ($dados['observacoes'] ?? '')),'parametros' => $dados['parametros'] ?? []];
    }
}
