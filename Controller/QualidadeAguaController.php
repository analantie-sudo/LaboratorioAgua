<?php

namespace QualidadeAgua;

use Model\Amostra;
use Model\QualidadeAgua;
use InvalidArgumentException;

class WaterController
{
    private Amostra $sample;
    private QualidadeAgua $quality;

    public function __construct()
    {
        $this->sample = new Amostra();
        $this->quality = new QualidadeAgua();
    }

    public function validate(array $data): array
    {
        $errors = [];

        foreach (QualidadeAgua::limits() as $key => $config) {
            if (!array_key_exists($key, $data) || $data[$key] === '') {
                $errors[$key] = 'Campo obrigatório.';
                continue;
            }

            if (!is_numeric($data[$key])) {
                $errors[$key] = 'Informe um número válido.';
            }
        }

        return $errors;
    }

    public function analisar(array $data): array
    {
        $errors = $this->validate($data);

        if ($errors !== []) {
            throw new InvalidArgumentException('Existem campos inválidos ou ausentes.');
        }

        return $this->sample->analisar($data);
    }

    public function referenceTable(): array
    {
        return $this->quality::limits();
    }
}