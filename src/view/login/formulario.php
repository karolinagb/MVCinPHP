<?php include __DIR__ . '/../inicio-html.php'; ?>

<form action="/realiza-login" method="POST">
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha">
        <button class="btn btn-primary">
            Entrar
        </button>
    </div>
</form>

<?php include __DIR__ . '/../fim-html.php'; ?>