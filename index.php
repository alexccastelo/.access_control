<?php
session_start();

$mensagem = "";
if (isset($_SESSION['mensagem_sucesso'])) {
    $mensagem = $_SESSION['mensagem_sucesso'];
    unset($_SESSION['mensagem_sucesso']); // Limpa a mensagem de sucesso
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="shortcut icon" href="images/s2b.ico" />
    <title>S2B</title>
</head>

<body>

    <div class="login-container">
        <?php if (!empty($mensagem)) : ?>
            <p class="mensagem sucesso"><?= $mensagem; ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['erro'])) : ?>
            <p class="mensagem erro">Usuário ou senha inválidos!</p>
        <?php endif; ?>
        <img src="images/logo.png" alt="Solution2B" height="150" width="150">
        <h3>Acesso ao site</h3>
        <form action="verificar_login.php" method="POST">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Entrar</button>
        </form>
        <!-- <br>Não tem cadastro? <a href="cadastro.php">Cadastre-se</a> </br> -->

    </div>
</body>

</html>