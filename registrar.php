<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';

$usuario = new Usuario($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $usuario->criar($nome, $sexo, $fone, $email, $senha);
    header('Location: crudusuario.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/registrar.css">
    <title>Adicionar Usuário</title>
</head>
<body>
    <div class="registrar-container">
        <h1>Cadastro de Usuário</h1>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" placeholder="Insira seu nome:" required>
            <br>

            <label>MASCULINO</label>
            <input type="radio" name="sexo" value="M" required>

            <label>FEMININO</label>
            <input type="radio" name="sexo" value="F" required>
            <br>

            <label for="telefone">Telefone:</label>
            <input type="text" name="fone" placeholder="Insira seu número:" required>
            <br>

            <label for="email">E-mail:</label>
            <input type="email" name="email" placeholder="E-mail:" required>
            <br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" placeholder="Senha:" required>
            <br>

            <input type="submit" value="Salvar">
            <input type="submit" value="Voltar" onclick="window.history.back();" class="button">

        </form>
    </div>
</body>
</html>
