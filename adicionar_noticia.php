<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

include_once './config/config.php';
include_once './classes/Noticias.php';

$noticias = new Noticias($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idusu = $_SESSION['usuario_id']; // Obtendo o ID do usuário da sessão
    $data = date('Y-m-d'); // Obtendo a data atual no formato MySQL (YYYY-MM-DD)
    $titulo = $_POST['titulo'];
    $noticia = $_POST['noticia'];
    
    // Inserindo a notícia utilizando o método da classe Noticias
    $noticias->inserir($idusu, $data, $titulo, $noticia);
    header('Location: crudnoticias.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/adicionar.css">
    <title>Adicionar Notícia</title>
</head>
<body>
    <div class="adicionar-noticia">
        <h1>Cadastro de Notícia</h1>
        <form method="POST">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" placeholder="Insira o título da notícia:" required>
            <br>

            <label for="noticia">Notícia:</label>
            <textarea name="noticia" rows="5" placeholder="Insira o conteúdo da notícia:" required></textarea>
            <br>

            <input type="submit" value="Salvar">
            <input type="button" value="Voltar" onclick="window.history.back();" class="button">
        </form>
    </div>
</body>
</html>
