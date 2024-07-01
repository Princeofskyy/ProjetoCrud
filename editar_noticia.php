<?php
session_start();

if(!isset($_SESSION['usuario_id'])){
    header('Location: index.php');
    exit();
}

include_once './config/config.php';
include_once './classes/Noticias.php';

$noticias = new Noticias($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idnot = $_POST['idnot'];
    $titulo = $_POST['titulo'];
    $noticia = $_POST['noticia'];
    $noticias->atualizar($idnot, $titulo, $noticia);
    header('Location: crudnoticias.php');
    exit();
}

if (isset($_GET['id'])){
    $idnot = $_GET['id'];
    $row = $noticias->lerPorId($idnot);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Notícia</title>
    <link rel="stylesheet" href="./css/editar_noticia.css">
</head>
<body>
    <div class="container">
        <h2>Editar Notícia</h2>
        <form method="POST">
            <input type="hidden" name="idnot" value="<?php echo $row['idnot']; ?>">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="<?php echo $row['titulo']; ?>" required>
            <br><br>
            <label for="noticia">Notícia:</label>
            <textarea name="noticia" rows="8" cols="80" required><?php echo $row['noticia']; ?></textarea>
            <br><br>
            <input type="submit" class="button" value="Atualizar">
            <input type="button" class="button" value="Cancelar" onclick="window.location.href='crudnoticias.php'">
        </form>
    </div>
</body>
</html>
