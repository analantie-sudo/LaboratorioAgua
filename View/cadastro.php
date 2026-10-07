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