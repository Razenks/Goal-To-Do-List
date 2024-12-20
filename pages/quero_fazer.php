<?php
session_start();

if (!isset($_SESSION['cpf'])) {
    header("Location: ./index.php?msgErro= Voce precisa de autenticar no sistema.");
    exit();
}

require_once '../config/conectaDB.php';
$cpf = $_SESSION['cpf'];

$sql = "SELECT id_card, titulo, descricao, data_inicio, data_prazo, importancia
            FROM cards
            WHERE importancia = 1 AND cpf = :cpf AND estado = 1";
$stmt = $pdo->prepare($sql);

//Estado 1 = Ativo, Estado 2 = Feito, Estado 3 = Desativado

$dados = [
    ':cpf' => $cpf
];
$stmt->execute($dados);
$cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do</title>
    <link rel="shortcut icon" href="../assets/escreva.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/pages.js"></script>
</head>

<body>
    <nav id="navegacao">
        <div>
            <h2>TO-DO</h2>
        </div>

        <div id="links">
            <ul>
                <li>Perfil</li>

                <p><a href="../config/logout.php" style="display: flex;"><i class="bi bi-box-arrow-in-left"></i>Sair</a>
                </p>
            </ul>
        </div>
    </nav>

    <main>
        <div class="menu">
            <ul>
                <li><a href="./adicionar.php" id="adicionar">Adicionar</a></li>
                <p>|</p>
                <li><a href="./quero_fazer.php" id="querof">Quero Fazer</a></li>
                <p>|</p>
                <li><a href="./obrigado_fazer.php" id="obrigadof">Obrigado a fazer</a></li>
                <p>|</p>
                <li><a href="./nao_fazer.php" id="naofazer">Não Quero fazer</a></li>
                <p>|</p>
                <li><a href="./feitos.php" id="feitos">Feitos</a></li>
                <p>|</p>
                <li><a href="./desativados.php" id="desativados">Desativados</a></li>
            </ul>
        </div>

        <?php
        if (!empty($cards)) {
            foreach ($cards as $card) {
                echo '<div class="cards">';
                echo '<div>';
                echo '<h1>' . $card['titulo'] . '</h1>';
                echo '</div>';
                echo '<div class="descricao">';
                echo '<textarea name="descricao" id="" value="" readonly>' . $card['descricao'] . '</textarea>';
                echo '</div>';
                echo '<div class="datas">';
                echo '<div class="data_inicio">';
                echo '<p>Data Inicio:</p>';
                echo '<p>' . $card['data_inicio'] . '</p>';
                echo '</div>';
                echo '<div class="data_prazo">';
                echo '<p>Data Prazo:</p>';
                echo '<p>' . $card['data_prazo'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '<div class="bottom">';
                echo '<div>';
                echo '<a href="card_page.php?id_card=' . $card['id_card'] . '"><button>Ver</button></a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </main>
</body>

</html>