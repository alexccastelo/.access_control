<?php
session_start(); // Inicia a sessão

// Limpa a sessão
session_unset();
session_destroy();

// Redireciona para a página de login
header('Location: index.php');
exit;
