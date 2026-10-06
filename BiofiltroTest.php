<?php

declare(strict_types=1);

namespace tests;

use Model\Biofiltro;
use PHPUnit\Framework\TestCase;

final class BiofiltroTest extends TestCase
{
    private Biofiltro $biofiltro;

    protected function setUp(): void
    {
        $this->biofiltro = new Biofiltro();
    }

    public function testCalculaEficienciaComValoresConhecidos(): void
    {
        $this->assertSame(40.0, $this->biofiltro->calcularEficiencia(100, 60));
    }

    public function testReducaoTotalResultaEmCemPorCento(): void
    {
        $this->assertSame(100.0, $this->biofiltro->calcularEficiencia(10, 0));
    }

    public function testSemReducaoResultaEmZeroPorCento(): void
    {
        $this->assertSame(0.0, $this->biofiltro->calcularEficiencia(10, 10));
    }

    public function testAumentoGeraEficienciaNegativa(): void
    {
        $this->assertSame(-20.0, $this->biofiltro->calcularEficiencia(10, 12));
    }

    public function testDivisaoPorZeroEhImpedida(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->biofiltro->calcularEficiencia(0, 5);
    }

    public function testValorDepoisDoFiltroNaoPodeSerNegativo(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->biofiltro->calcularEficiencia(10, -1);
    }

    public function testComparacaoCalculaEficienciaDosParametros(): void
    {
        $resultado = $this->biofiltro->comparar(['turbidez' => 10, 'ferro' => 1],['turbidez' => 4, 'ferro' => 0.7]);

        $this->assertSame(60.0, $resultado['turbidez']['eficiencia']);
        $this->assertSame(30.0, $resultado['ferro']['eficiencia']);
    }
}
