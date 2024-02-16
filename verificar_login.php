<?php
session_start(); // Inicia a sessão no início do arquivo

try {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha']; // Não use MD5 aqui

    // Conexão com o banco de dados (considere usar variáveis de ambiente ou um arquivo de configuração)
    $pdo = new PDO('mysql:host=208.115.238.2;dbname=d2dtecno_access_control', 'd2dtecno_root', 'fEcr=fr6');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare a query para executar
    $query = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
    $query->bindParam(':usuario', $usuario);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    // Verifique se a senha está correta
    if ($resultado && password_verify($senha, $resultado['senha'])) {
        // Define variáveis de sessão e redireciona para o painel
        $_SESSION['usuario_id'] = $resultado['id'];
        $_SESSION['usuario_nome'] = $resultado['usuario'];

        header('Location: painel.php');
        exit; // Encerra a execução do script
    } else {
        // Login falhou, redireciona de volta para index.php com uma flag de erro
        header('Location: index.php?erro=1');
        exit; // Encerra a execução do script
    }
} catch (PDOException $e) {
    // Tratar erro de conexão ou consulta
    error_log($e->getMessage());
    // Redirecionar para uma página de erro ou mostrar uma mensagem de erro
}

