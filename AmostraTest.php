<?php

declare(strict_types=1);

namespace Testes;

use Model\Amostra;
use PHPUnit\Framework\TestCase;

final class AmostraTest extends TestCase
{
    private Amostra $amostra;

    protected function setUp(): void
    {
        $this->amostra = new Amostra();
    }

    public function testCriaAmostraValida(): void
    {
        $resultado = $this->amostra->criar(['nome' => 'Amostra do laboratório','data_coleta' => '2026-10-06','observacoes' => 'Dados medidos pela equipe.','parametros' => ['ph' => 7.0]]);

        $this->assertSame('Amostra do laboratório', $resultado['nome']);
        $this->assertSame('2026-10-06', $resultado['data_coleta']);
    }

    public function testNomeAusenteGeraErro(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->amostra->criar(['data_coleta' => '2026-10-06']);
    }

    public function testDataAusenteGeraErro(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->amostra->criar(['nome' => 'Amostra']);
    }
}