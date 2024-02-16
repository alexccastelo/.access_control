<?php
session_start(); // Iniciar sessão para usar variáveis de sessão

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php'); // Se não estiver logado, redireciona para a página de login
    exit;
}

include 'verificar_login.php'; // Script de conexão e verificação de login

// Inicializa variáveis
$usuario = '';
$ativo = 'nao';
$id = '';

// Checa se estamos recebendo um ID de usuário
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "SELECT usuario, ativo FROM usuarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $usuario = $resultado['usuario'];
            $ativo = $resultado['ativo'];
        } else {
            $_SESSION['mensagem_erro'] = 'Usuário não encontrado.';
            header('Location: listar_usuarios.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['mensagem_erro'] = 'Erro ao buscar informações do usuário: ' . $e->getMessage();
        header('Location: listar_usuarios.php');
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['usuario'], $_POST['ativo'])) {
    // Processa o formulário de edição
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $ativo = $_POST['ativo'] === 'sim' ? 'sim' : 'nao';

    try {
        $sql = "UPDATE usuarios SET usuario = :usuario, ativo = :ativo WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':usuario' => $usuario, ':ativo' => $ativo, ':id' => $id]);

        $_SESSION['mensagem_sucesso'] = 'Usuário atualizado com sucesso.';
        header('Location: listar_usuarios.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem_erro'] = 'Erro ao atualizar o usuário: ' . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="shortcut icon" href="images/s2b.ico" />
    <title>Editar Usuário</title>
</head>

<body>
    <div class="painel-container">
        <h2>Editar Usuário</h2>
        <form action="editar_usuario.php" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuario); ?>" required>
            <label for="ativo">Ativo:</label>
            <select id="ativo" name="ativo">
                <option value="sim" <?= $ativo == 'sim' ? 'selected' : ''; ?>>Sim</option>
                <option value="nao" <?= $ativo == 'nao' ? 'selected' : ''; ?>>Não</option>
            </select>
            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>

</html>