<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

include_once './config/config.php';
include_once './classes/Noticia.php'; 

$noticia = new Noticias($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idnot = $_POST['idnot'];
    $titulo = $_POST['titulo'];
    $noticia = $_POST['noticia'];
   
    $noticia->atualizar($idnot, $titulo, $noticia); 

    header('Location: crudnoticias.php');
    exit();
}
if (isset($_GET['idnot'])) {
    $idnot = $_GET['idnot'];
    $row = $noticia->lerPorId($idnot); 
} else {
  
    header('Location: crudnoticias.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Notícia</title>
    <link rel="stylesheet" href="./css/mudar.css">
</head>
<body>
    <div class="editar-container">
        <h1>Editar Notícia</h1>
        <form method="POST">
            <input type="hidden" name="idnot" value="<?php echo $row['idnot']; ?>">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="<?php echo $row['titulo']; ?>" required>
            <br><br>
            <label for="noticia">Notícia:</label>
            <textarea name="noticia" rows="5" required><?php echo $row['noticia']; ?></textarea>
            <br><br>
            <input type="submit" value="Atualizar">
            <button type="button" onclick="window.history.back();" class="button">Voltar</button>
        </form>
    </div>
</body>
</html>
