<?php
session_start(); // Iniciar sessão para usar variáveis de sessão

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php'); // Se não estiver logado, redireciona para a página de login
    exit;
}

// Conexão com o banco de dados
try {
    $pdo = new PDO('mysql:host=208.115.238.2;dbname=d2dtecno_access_control', 'd2dtecno_root', 'fEcr=fr6');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, usuario, ativo FROM usuarios";
    $stmt = $pdo->query($sql); // Definição da variável $stmt para a consulta SQL
} catch (PDOException $e) {
    // Tratamento de erro
    $_SESSION['mensagem_erro'] = 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
    header('Location: painel.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- cabeçalho da página -->
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="shortcut icon" href="images/s2b.ico" />
    <title>Lista de Usuários</title>
</head>

<body>
    <div class="painel-container">
        <img src="images/logo.png" alt="Solution2B" height="150" width="150">
        <h2>Usuários Cadastrados</h2>
        <table>
            <tr>
                <th>Usuário</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['usuario']); ?></td>
                    <td><?= htmlspecialchars($row['ativo']); ?></td>
                    <td>
                        <a href="alterar_status.php?id=<?= htmlspecialchars($row['id']); ?>&status=<?= htmlspecialchars($row['ativo']); ?>"><?= $row['ativo'] == 'sim' ? 'Desativar' : 'Ativar'; ?></a>
                        | <a href="editar_usuario.php?id=<?= htmlspecialchars($row['id']); ?>">Editar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <nav class="menu">
            <ul>
                <li><a href="painel.php">Painel</a></li>
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