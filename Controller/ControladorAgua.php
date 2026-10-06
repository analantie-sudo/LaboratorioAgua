<?php

declare(strict_types=1);

namespace ControladorAgua;

use Model\QualidadeAgua;

class ControladorAgua
{
    public static function analisar(array $dados): array
    {
        $resultados = QualidadeAgua::analisar($dados);

        return [
            'resultados' => $resultados,
            'parecer' => QualidadeAgua::gerarParecer($resultados),
        ];
    }
}
