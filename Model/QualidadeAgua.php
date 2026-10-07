<?php

declare(strict_types=1);

namespace Model;

class QualidadeAgua
{
    private const FAIXAS = [
        'ph' => ['nome' => 'pH', 'minimo' => 6.0, 'maximo' => 9.5, 'unidade' => ''],
        'turbidez' => ['nome' => 'Turbidez', 'minimo' => 0.0, 'maximo' => 5.0, 'unidade' => 'NTU'],
        'cloro_residual' => ['nome' => 'Cloro residual livre', 'minimo' => 0.2, 'maximo' => 5.0, 'unidade' => 'mg/L'],
        'cor_aparente' => ['nome' => 'Cor aparente', 'minimo' => 0.0, 'maximo' => 15.0, 'unidade' => 'uH'],
        'nitrato' => ['nome' => 'Nitrato', 'minimo' => 0.0, 'maximo' => 10.0, 'unidade' => 'mg/L como N'],
        'fluoreto' => ['nome' => 'Fluoreto', 'minimo' => 0.0, 'maximo' => 1.5, 'unidade' => 'mg/L']
    ];

    public function obterFaixas(): array
    {
        return self::FAIXAS;
    }

    public function classificar(string $parametro, float $valor): string
    {
        if (!isset(self::FAIXAS[$parametro])) {
            throw new ArgumentoInvalido('Parâmetro de qualidade da água não cadastrado.');
        }

        if (!is_finite($valor)) {
            throw new ArgumentoInvalido('O valor informado deve ser um número finito.');
        }

        $faixa = self::FAIXAS[$parametro];

        if ($valor < 0) {
            throw new ArgumentoInvalido('O valor informado não pode ser negativo.');
        }

        if ($parametro === 'ph' && ($valor < 0 || $valor > 14)) {
            throw new ArgumentoInvalido('O valor de pH deve estar entre 0 e 14.');
        }

        if ($valor < $faixa['minimo'] || $valor > $faixa['maximo']) {
            return 'Fora do padrão';
        }

        return 'Dentro do padrão';
    }

    public function analisar(array $dados): array
    {
        $resultados = [];

        foreach (self::FAIXAS as $parametro => $faixa) {
            if (!array_key_exists($parametro, $dados) || $dados[$parametro] === '') {
                throw new ArgumentoInvalido("O campo {$faixa['nome']} é obrigatório.");
            }

            if (!is_numeric($dados[$parametro])) {
                throw new ArgumentoInvalido("O valor de {$faixa['nome']} é inválido.");
            }

            $valor = (float) $dados[$parametro];

            $resultados[$parametro] = ['nome' => $faixa['nome'],'valor' => $valor,'unidade' => $faixa['unidade'],'classificacao' => $this->classificar($parametro, $valor)];
        }

        return $resultados;
    }

    public function gerarParecer(array $resultados): string
    {
        $foraDoPadrao = 0;

        foreach ($resultados as $resultado) {
            if (($resultado['classificacao'] ?? '') === 'Fora do padrão') {
                $foraDoPadrao++;
            }
        }

        if ($foraDoPadrao === 0) {
            return 'A amostra está dentro dos padrões considerados pelo laboratório.';
        }

        return "A amostra apresenta {$foraDoPadrao} parâmetro(s) fora dos padrões considerados pelo laboratório.";
    }
}


