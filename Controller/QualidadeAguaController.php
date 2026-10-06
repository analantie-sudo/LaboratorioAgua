<?php

declare(strict_types=1);

namespace QualidadeAguaController;

use Model\QualidadeAgua;

class QualidadeAguaController
{
    private QualidadeAgua $modeloQualidade;

    public function __construct()
    {
        $this->modeloQualidade = new QualidadeAgua();
    }

    public function validarDados(array $dados): ?string
    {
        foreach ($this->modeloQualidade->obterFaixas() as $parametro => $faixa) {
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
            throw new InvalidArgumentException($erro);
        }

        $resultados = $this->modeloQualidade->analisar($dados);

        return ['resultados' => $resultados,'parecer' => $this->modeloQualidade->gerarParecer($resultados)
        ];
    }

    public function obterReferencias(): array
    {
        return $this->modeloQualidade->obterFaixas();
    }
}
