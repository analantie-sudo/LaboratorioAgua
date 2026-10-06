<?php

declare(strict_types=1);

namespace tests;

use Model\QualidadeAgua;
use PHPUnit\Framework\TestCase;

final class QualidadeAguaTest extends TestCase
{
    private QualidadeAgua $qualidade;

    protected function setUp(): void
    {
        $this->qualidade = new QualidadeAgua();
    }

    public function testPhDentroDaFaixa(): void
    {
        $this->assertSame('Dentro do padrão', $this->qualidade->classificar('ph', 7.0));
    }

    public function testPhNoLimiteInferior(): void
    {
        $this->assertSame('Dentro do padrão', $this->qualidade->classificar('ph', 6.0));
    }

    public function testPhNoLimiteSuperior(): void
    {
        $this->assertSame('Dentro do padrão', $this->qualidade->classificar('ph', 9.5));
    }

    public function testPhForaDaFaixa(): void
    {
        $this->assertSame('Fora do padrão', $this->qualidade->classificar('ph', 5.9));
    }

    public function testPhFisicamenteImpossivelGeraErro(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->qualidade->classificar('ph', 15);
    }

    public function testValorNegativoGeraErro(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->qualidade->classificar('turbidez', -1);
    }

    public function testParametroDesconhecidoGeraErro(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->qualidade->classificar('salinidade', 1);
    }

    public function testCampoAusenteGeraErro(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->qualidade->analisar(['ph' => 7.0]);
    }

    public function testTodosOsParametrosDentroDoPadraoGeramParecerFavoravel(): void
    {
        $dados = [];
        foreach ($this->qualidade->obterFaixas() as $parametro => $faixa) {
            $dados[$parametro] = ($faixa['minimo'] + $faixa['maximo']) / 2;
        }

        $resultados = $this->qualidade->analisar($dados);

        $this->assertStringContainsString(
            'dentro dos padrões',
            $this->qualidade->gerarParecer($resultados)
        );
    }

    public function testParametroForaDoPadraoGeraParecerDesfavoravel(): void
    {
        $dados = [];
        foreach ($this->qualidade->obterFaixas() as $parametro => $faixa) {
            $dados[$parametro] = ($faixa['minimo'] + $faixa['maximo']) / 2;
        }
        $dados['ph'] = 5.5;

        $resultados = $this->qualidade->analisar($dados);

        $this->assertStringContainsString(
            'fora dos padrões',
            $this->qualidade->gerarParecer($resultados)
        );
    }
}