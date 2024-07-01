<?php

session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';

$usuario = new Usuario($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Processar login
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if ($dados_usuario = $usuario->Login($email, $senha)) {
            $_SESSION['usuario_id'] = $dados_usuario['id'];
            error_log("Login bem-sucedido para o usuário ID: " . $dados_usuario['id']); // Debug
            header('Location: portal.php');
            exit();
        } else {
            error_log("Falha no login para o email: $email"); // Debug
            $mensagem_erro = "Credenciais inválidas!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Autenticação</title>
</head>
<body class="login">
    <div class="container">
        <form method="POST">
            <h1>Login</h1>
            <label for="email">E-mail:</label>
            <input type="email" name="email" placeholder="Insira o e-mail:" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" placeholder="Insira sua senha:" required>

            <input type="submit" value="Entrar" name="login">
        </form>
        <p>Não tem conta? <a href="./registrar.php">Registre-se aqui</a></p>
        <p><a href="./solicitar_recuperacao.php" class="esqueci">Esqueci a senha</a></p>
        <div class="mensagem">
            <?php
            if (isset($mensagem_erro)) {
                echo '<p>'.$mensagem_erro.'</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
