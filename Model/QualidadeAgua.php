<?php

declare(strict_types=1);

namespace Model;

use InvalidArgumentException;

class QualidadeAgua
{
    private const FAIXAS = [
        'ph' => ['minimo' => 6.0, 'maximo' => 9.5, 'unidade' => '', 'nome' => 'pH'],
        'turbidez' => ['minimo' => 0.0, 'maximo' => 5.0, 'unidade' => 'NTU', 'nome' => 'Turbidez'],
        'cloro_residual' => ['minimo' => 0.2, 'maximo' => 5.0, 'unidade' => 'mg/L', 'nome' => 'Cloro residual livre'],
        'dureza' => ['minimo' => 0.0, 'maximo' => 500.0, 'unidade' => 'mg/L CaCO3', 'nome' => 'Dureza'],
        'temperatura' => ['minimo' => 0.0, 'maximo' => 45.0, 'unidade' => '°C', 'nome' => 'Temperatura'],
        'cor_aparente' => ['minimo' => 0.0, 'maximo' => 15.0, 'unidade' => 'uH', 'nome' => 'Cor aparente'],
        'cloretos' => ['minimo' => 0.0, 'maximo' => 250.0, 'unidade' => 'mg/L', 'nome' => 'Cloretos'],
        'nitrato' => ['minimo' => 0.0, 'maximo' => 10.0, 'unidade' => 'mg/L como N', 'nome' => 'Nitrato'],
        'ferro' => ['minimo' => 0.0, 'maximo' => 0.3, 'unidade' => 'mg/L', 'nome' => 'Ferro'],
        'manganes' => ['minimo' => 0.0, 'maximo' => 0.1, 'unidade' => 'mg/L', 'nome' => 'Manganês'],
        'fluoreto' => ['minimo' => 0.0, 'maximo' => 1.5, 'unidade' => 'mg/L', 'nome' => 'Fluoreto'],
    ];

    public static function obterFaixas(): array
    {
        return self::FAIXAS;
    }

    public static function classificar(string $parametro, float $valor): string
    {
        if (!isset(self::FAIXAS[$parametro])) {
            throw new InvalidArgumentException('Parâmetro de qualidade da água não cadastrado.');
        }

        if (!is_finite($valor)) {
            throw new InvalidArgumentException('O valor informado deve ser um número finito.');
        }

        $faixa = self::FAIXAS[$parametro];

        if ($valor < $faixa['minimo'] || $valor > $faixa['maximo']) {
            return 'Fora do padrão';
        }

        return 'Dentro do padrão';
    }

    public static function analisar(array $dados): array
    {
        $resultados = [];

        foreach (self::FAIXAS as $parametro => $faixa) {
            if (!array_key_exists($parametro, $dados) || $dados[$parametro] === '') {
                $resultados[$parametro] = ['nome' => $faixa['nome'], 'valor' => null, 'unidade' => $faixa['unidade'], 'classificacao' => 'Não informado'];
                continue;
            }

            $valor = filter_var($dados[$parametro], FILTER_VALIDATE_FLOAT);
            if ($valor === false) {
                throw new InvalidArgumentException("O valor de {$faixa['nome']} é inválido.");
            }

            $resultados[$parametro] = ['nome' => $faixa['nome'], 'valor' => (float) $valor, 'unidade' => $faixa['unidade'], 'classificacao' => self::classificar($parametro, (float) $valor)];
        }

        return $resultados;
    }

    public static function gerarParecer(array $resultados): string
    {
        $foraDoPadrao = 0;
        $informados = 0;

        foreach ($resultados as $resultado) {
            if ($resultado['classificacao'] !== 'Não informado') {
                $informados++;
            }
            if ($resultado['classificacao'] === 'Fora do padrão') {
                $foraDoPadrao++;
            }
        }

        if ($informados === 0) {
            return 'Não é possível emitir um parecer: nenhum parâmetro foi informado.';
        }

        if ($foraDoPadrao === 0) {
            return 'A amostra está dentro dos padrões considerados pelo laboratório.';
        }

        return "A amostra apresenta {$foraDoPadrao} parâmetro(s) fora dos padrões considerados. Recomenda-se investigar a causa e avaliar o tratamento da água.";
    }
}

