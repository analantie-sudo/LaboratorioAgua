<?php

declare(strict_types=1);

namespace Controller;

use Model\QualidadeAgua;
use Model\ArgumentoInvalido;

class ControladorQualidadeAgua
{
    private QualidadeAgua $qualidadeAgua;

    public function __construct()
    {
        $this->qualidadeAgua = new QualidadeAgua();
    }

    public function validarDados(array $dados): ?string
    {
        foreach ($this->qualidadeAgua->obterFaixas() as $parametro => $faixa) {
            if (!array_key_exists($parametro, $dados) || $dados[$parametro] === '') {
                return "O campo {$faixa['nome']} é obrigatório.";
            }

            if (!is_numeric($dados[$parametro])) {
                return "O valor de {$faixa['nome']} deve ser numérico.";
            }
        }

        return null;
    }

    public function analisarAmostra(array $dados): array
    {
        $erro = $this->validarDados($dados);

        if ($erro !== null) {
            throw new ArgumentoInvalido($erro);
        }

        $resultados = $this->qualidadeAgua->analisar($dados);

        return [
            'resultados' => $resultados,
            'parecer' => $this->qualidadeAgua->gerarParecer($resultados)
        ];
    }

    public function obterReferencias(): array
    {
        return $this->qualidadeAgua->obterFaixas();
    }
}
