<?php
include_once './config/config.php';
include_once './classes/Usuario.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $usuario = new Usuario($db);
    $codigo = $usuario->gerarCodigoVerificacao($email);

    if ($codigo) {
        $mensagem = "Seu código de verificação é: $codigo. Por favor, anote o código e <a href='redefinir_senha.php'>clique aqui</a> para redefinir sua senha.";
    } else {
        $mensagem = 'E-mail não encontrado.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="./css/recuperacao.css">
</head>
<body>
    <div class="recuperar-container">
        <h1>Recuperar Senha</h1>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <div class="button-container">
                <input type="submit" value="Enviar">
                <input type="button" value="Voltar" onclick="window.location.href='index.php';">
            </div>
        </form>
        <p><?php echo $mensagem; ?></p>
    </div>
</body>
</html>
