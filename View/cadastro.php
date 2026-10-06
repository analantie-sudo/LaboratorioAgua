<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Controlador\ControladorAgua;

$controladorAgua = new ControladorAgua();
$faixas = $controladorAgua->obterReferencias();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Amostra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../templates/css/global.css">
</head>
<body>
<main class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Cadastro de amostra</h1>
            <p class="text-muted mb-0">Informe os dados realmente medidos pela equipe.</p>
        </div>
        <a href="index.php" class="btn btn-outline-primary">Voltar</a>
    </div>

    <form action="index.php" method="post" class="card p-4 shadow-sm">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome da amostra</label>
                <input id="nome" name="nome" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="data_coleta" class="form-label">Data da coleta</label>
                <input id="data_coleta" type="date" name="data_coleta" class="form-control" required>
            </div>
        </div>

        <hr class="my-4">

        <h2 class="h4">Parâmetros de qualidade</h2>
        <p class="text-muted">Preencha com os valores obtidos nas medições reais.</p>

        <div class="row g-3">
            <?php foreach ($faixas as $chave => $faixa): ?>
                <div class="col-md-4">
                    <label class="form-label" for="parametro_<?= htmlspecialchars($chave) ?>">
                        <?= htmlspecialchars($faixa['nome']) ?>
                        <?php if ($faixa['unidade'] !== ''): ?>
                            (<?= htmlspecialchars($faixa['unidade']) ?>)
                        <?php endif; ?>
                    </label>
                    <input
                        id="parametro_<?= htmlspecialchars($chave) ?>"
                        type="number"
                        step="any"
                        name="parametros[<?= htmlspecialchars($chave) ?>]"
                        class="form-control"
                        required
                    >
                    <small class="text-muted">
                        Referência: <?= $faixa['minimo'] ?> a <?= $faixa['maximo'] ?>
                    </small>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-4">
            <label for="observacoes" class="form-label">Observações</label>
            <textarea id="observacoes" name="observacoes" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-primary mt-4" type="submit">Analisar amostra</button>
    </form>
</main>
</body>
</html>
