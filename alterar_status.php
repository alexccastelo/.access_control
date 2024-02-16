<?php
session_start(); // Iniciar sessão para usar variáveis de sessão

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php'); // Se não estiver logado, redireciona para a página de login
    exit;
}

// Checagem para garantir que o ID e o status foram passados
if (!isset($_GET['id']) || !isset($_GET['status'])) {
    $_SESSION['mensagem_erro'] = 'Dados necessários para alterar o status não foram fornecidos.';
    header('Location: listar_usuarios.php');
    exit;
}

$id = $_GET['id'];
$statusAtual = $_GET['status'];
$novoStatus = ($statusAtual == 'sim' ? 'nao' : 'sim');

include 'verificar_login.php'; // Script de conexão e verificação de login

try {
    $sql = "UPDATE usuarios SET ativo = :novoStatus WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':novoStatus' => $novoStatus, ':id' => $id]);

    $_SESSION['mensagem_sucesso'] = 'Status do usuário alterado com sucesso.';
} catch (PDOException $e) {
    $_SESSION['mensagem_erro'] = 'Erro ao alterar o status do usuário: ' . $e->getMessage();
}

header('Location: listar_usuarios.php');
exit;
