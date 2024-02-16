<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php'); // Redireciona para a página de login se não estiver logado
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Painel do Usuário</title>
</head>

<body>
    <div class="painel-container">
        <img src="images/logo.png" alt="Solution2B" height="150" width="150">
        <h1>Bem-vindo ao Painel</h1>
        <nav class="menu">
            <ul>
                <li><a href="https://webmail.d2dtecnologia.com.br/" target="_blank">Webmail D2D</a></li>
                <li><a href="https://webmail.espacovital.med.br/" target="_blank">Webmail Espaço Vital</a></li>
                <li><a href="https://webmail.solution2b.net/" target="_blank">Webmail Solution2B</a></li>
                <li><a href="cadastro.php" target="">Cad. Usuários</a></li>
                <li><a href="listar_usuarios.php" target="">List. Usuários</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</body>

</html>