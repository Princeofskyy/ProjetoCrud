<?php
session_start();
include_once './config/config.php';
include_once './classes/Noticias.php';

$noticias = new Noticias($db);
$dados_noticias = $noticias->ler();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Notícias</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>

<body>
    <?php include './header&footer/header.php'; ?>

    <div class="portal">
        <h1>Notícias</h1>
        <div class="box">
            <?php while ($noticia = $dados_noticias->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="noticia">
                    <h2><?php echo htmlspecialchars($noticia['titulo']); ?></h2>
                    <p><?php echo htmlspecialchars($noticia['noticia']); ?></p>
                    <p>Data: <?php echo htmlspecialchars($noticia['data']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        <?php include './header&footer/footer.php'; ?>
    </div>

</body>

</html>