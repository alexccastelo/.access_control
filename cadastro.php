<?php
session_start(); // Iniciar sessão para usar variáveis de sessão
$mensagem = "";
$classeMensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Validações para e-mail e senha aqui...
    // Se as validações passarem, prossiga com a inserção no banco de dados

    try {
        $pdo = new PDO('mysql:host=208.115.238.2;dbname=d2dtecno_access_control', 'd2dtecno_root', 'fEcr=fr6');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se o e-mail já existe
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);

        if ($stmt->rowCount() > 0) {
            $mensagem = "Usuário já cadastrado.";
            $classeMensagem = "mensagem erro";
        } else {
            // A senha já deve ter sido validada aqui
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (usuario, senha) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$usuario, $senhaHash]);

            // Cadastro bem-sucedido
            $_SESSION['mensagem_sucesso'] = "Usuário cadastrado com sucesso!";
            header('Location: painel.php');
            exit;
        }
    } catch (PDOException $e) {
        $mensagem = "Erro ao cadastrar usuário: " . $e->getMessage();
        $classeMensagem = "mensagem erro";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- cabeçalho da página -->
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="shortcut icon" href="images/s2b.ico" />
    <title>Cadastro de Usuários</title>
</head>

<body>
    <div class="login-container">

        <?php if (!empty($mensagem)) : ?>
            <p class="<?= $classeMensagem ?>"><?= $mensagem; ?></p>
        <?php endif; ?>
        <h3>Cadastro de Usuários</h3>
        <form action="cadastro.php" method="post">
            <label for="usuario">Usuário (E-mail):</label>
            <input type="email" id="usuario" name="usuario" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Cadastrar</button>
            <nav class="menu">
                <ul>
                    <li><a href="painel.php">Painel</a></li>
                    <li><a href="https://webmail.d2dtecnologia.com.br/" target="_blank">Webmail D2D</a></li>
                    <li><a href="https://webmail.espacovital.med.br/" target="_blank">Webmail Espaço Vital</a></li>
                    <li><a href="https://webmail.solution2b.net/" target="_blank">Webmail Solution2B</a></li>
                    <li>Cad. Usuários</li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </form>
    </div>
</body>

</html>