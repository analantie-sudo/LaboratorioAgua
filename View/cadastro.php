<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Amostra - Laboratório da Água</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="/templates/css/global.css">
</head>

<body>

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">
            Laboratório Digital da Água
        </span>

        <a href="../index.php" class="btn btn-light">
            Voltar
        </a>
    </div>
</nav>

<main class="container py-5">

    <div class="card shadow-sm">

        <div class="card-body">

            <h1 class="h3 mb-4">
                Cadastro de amostra
            </h1>

            <form action="../index.php" method="POST">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label for="nome" class="form-label">
                            Nome da amostra
                        </label>

                        <input
                            id="nome"
                            name="nome"
                            type="text"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-6">

                        <label for="data_coleta" class="form-label">
                            Data da coleta
                        </label>

                        <input
                            id="data_coleta"
                            type="date"
                            name="data_coleta"
                            class="form-control"
                            required
                        >

                    </div>

                </div>

                <hr class="my-4">

                <h2 class="h4">
                    Parâmetros de qualidade
                </h2>

                <p class="text-muted">
                    Preencha com os valores obtidos nas medições.
                </p>

                <div class="row g-3">

                    <!-- pH -->

                    <div class="col-md-4">

                        <label
                            for="ph"
                            class="form-label"
                        >
                            pH
                        </label>

                        <input
                            id="ph"
                            type="number"
                            name="parametros[ph]"
                            class="form-control"
                            step="0.01"
                            min="0"
                            max="14"
                            required
                        >

                        <small class="text-muted">
                            Referência: 6,0 a 9,5
                        </small>

                    </div>


                    <!-- Turbidez -->

                    <div class="col-md-4">

                        <label
                            for="turbidez"
                            class="form-label"
                        >
                            Turbidez (NTU)
                        </label>

                        <input
                            id="turbidez"
                            type="number"
                            name="parametros[turbidez]"
                            class="form-control"
                            step="0.01"
                            min="0"
                            required
                        >

                        <small class="text-muted">
                            Referência: 0 a 5 NTU
                        </small>

                    </div>


                    <!-- Cloro residual -->

                    <div class="col-md-4">

                        <label
                            for="cloro_residual"
                            class="form-label"
                        >
                            Cloro residual livre (mg/L)
                        </label>

                        <input
                            id="cloro_residual"
                            type="number"
                            name="parametros[cloro_residual]"
                            class="form-control"
                            step="0.01"
                            min="0"
                            required
                        >

                        <small class="text-muted">
                            Referência: 0,2 a 5 mg/L
                        </small>

                    </div>


                    <!-- Cor aparente -->

                    <div class="col-md-4">

                        <label
                            for="cor_aparente"
                            class="form-label"
                        >
                            Cor aparente (uH)
                        </label>

                        <input
                            id="cor_aparente"
                            type="number"
                            name="parametros[cor_aparente]"
                            class="form-control"
                            step="0.01"
                            min="0"
                            required
                        >

                        <small class="text-muted">
                            Referência: 0 a 15 uH
                        </small>

                    </div>


                    <!-- Nitrato -->

                    <div class="col-md-4">

                        <label
                            for="nitrato"
                            class="form-label"
                        >
                            Nitrato (mg/L como N)
                        </label>

                        <input
                            id="nitrato"
                            type="number"
                            name="parametros[nitrato]"
                            class="form-control"
                            step="0.01"
                            min="0"
                            required
                        >

                        <small class="text-muted">
                            Referência: 0 a 10 mg/L
                        </small>

                    </div>


                    <!-- Fluoreto -->

                    <div class="col-md-4">

                        <label
                            for="fluoreto"
                            class="form-label"
                        >
                            Fluoreto (mg/L)
                        </label>

                        <input
                            id="fluoreto"
                            type="number"
                            name="parametros[fluoreto]"
                            class="form-control"
                            step="0.01"
                            min="0"
                            required
                        >

                        <small class="text-muted">
                            Referência: 0 a 1,5 mg/L
                        </small>

                    </div>

                </div>


                <div class="mt-4">

                    <label
                        for="observacoes"
                        class="form-label"
                    >
                        Observações
                    </label>

                    <textarea
                        id="observacoes"
                        name="observacoes"
                        class="form-control"
                        rows="3"
                    ></textarea>

                </div>


                <div class="mt-4">

                    <button
                        class="btn btn-primary"
                        type="submit"
                    >
                        Analisar amostra
                    </button>

                    <a
                        href="../index.php"
                        class="btn btn-secondary"
                    >
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</main>

</body>

</html>