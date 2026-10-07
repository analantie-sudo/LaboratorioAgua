<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Controller\ControladorQualidadeAgua;
use Model\Amostra;

$controladorAgua = new ControladorQualidadeAgua();;
$resultado = null;
$erro = null;
$nomeAmostra = '';
$dataColeta = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $amostra = (new Amostra())->criar($_POST);
        $nomeAmostra = $amostra['nome'];
        $dataColeta = $amostra['data_coleta'];
        $resultado = $controladorAgua->analisarAmostra($amostra['parametros']);
    } catch (Throwable $excecao) {
        $erro = $excecao->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratório da Água</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../templates/css/global.css">
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">Laboratório Digital da Água</span>
        <a href="View/referencias.php" class="btn btn-light">Referências</a>
    </div>
</nav>

<main class="container py-5">
    <div class="p-5 mb-4 bg-light rounded-4">
        <h1 class="display-6">Laboratório da Água + Biofiltro Experimental</h1>
        <p class="lead">Sistema educacional para analisar a qualidade da água e avaliar a eficiência experimental de um biofiltro.</p>
        <a href="View/cadastro.php" class="btn btn-primary btn-lg">Cadastrar amostra</a>
    </div>

    <?php if ($erro !== null): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <?php if ($resultado !== null): ?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="h4">Resultado da análise</h2>
                <p><strong>Amostra:</strong> <?= htmlspecialchars($nomeAmostra) ?></p>
                <p><strong>Data da coleta:</strong> <?= htmlspecialchars($dataColeta) ?></p>
                <p class="mb-0"><strong>Parecer:</strong> <?= htmlspecialchars($resultado['parecer']) ?></p>
            </div>
        </section>

        <section class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>Parâmetro</th>
                        <th>Valor</th>
                        <th>Unidade</th>
                        <th>Classificação</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($resultado['resultados'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nome']) ?></td>
                        <td><?= htmlspecialchars((string) $item['valor']) ?></td>
                        <td><?= htmlspecialchars($item['unidade']) ?></td>
                        <td><?= htmlspecialchars($item['classificacao']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    <?php endif; ?>
</main>
</body>
</html>
