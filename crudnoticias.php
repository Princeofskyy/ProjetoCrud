<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include_once './config/config.php';
include_once './classes/Noticias.php'; // Incluir a classe Noticias.php

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

$noticias = new Noticias($db); // Instanciar a classe Noticias

// Processar exclusão de notícia
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $noticias->deletar($id);
    header('Location: portal.php');
    exit();
}

// Obter parâmetros de pesquisa e filtros
$search = isset($_GET['search']) ? $_GET['search'] : '';
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : '';

// Obter dados das notícias com filtros
$dados = $noticias->ler($search, $order_by);

// Função para determinar a saudação com nome do usuário
function saudacao($nome_usuario)
{
    $hora = date('H');
    if ($hora >= 6 && $hora < 12) {
        return "Bom dia, qual a notícia hoje?" ;
    } elseif ($hora >= 12 && $hora < 18) {
        return "Boa tarde, qual a notícia hoje?";
    } else {
        return "Boa noite, qual a notícia hoje?";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Portal</title>
    <link rel="stylesheet" href="./css/crud.css">
</head>

<body>
    <header class="header">
        <h1>Bem-vindo ao Portal de Notícias</h1>
        <nav>
            <a href="portal.php">Home</a>
            <a href="adicionar_noticia.php">Adicionar Notícia</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <div class="container">
        <h1><?php echo saudacao($nome_usuario); ?>!</h1>
        <!-- Formulário para filtro -->
        <form method="GET">
            <input type="text" name="search" placeholder="Pesquisar por título ou notícia"
                value="<?php echo htmlspecialchars($search); ?>">
            <label>
                <input type="radio" name="order_by" value="" <?php if ($order_by == '') echo 'checked'; ?>> Normal
            </label>
            <label>
                <input type="radio" name="order_by" value="titulo" <?php if ($order_by == 'titulo') echo 'checked'; ?>>
                Ordem Alfabética
            </label>
            <label>
                <input type="radio" name="order_by" value="data" <?php if ($order_by == 'data') echo 'checked'; ?>> Data
            </label>
            <button type="submit">Pesquisar</button>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Notícia</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['idnot']; ?></td>
                <td><?php echo $row['titulo']; ?></td>
                <td><?php echo $row['noticia']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($row['data'])); ?></td>
                <td>
                    <a href="editar_noticia.php?id=<?php echo $row['idnot']; ?>">Editar</a>
                    <a href="deletar_noticia.php?id=<?php echo $row['idnot']; ?>">Deletar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Portal de Notícias. Todos os direitos reservados.</p>
    </footer>
</body>

</html>
