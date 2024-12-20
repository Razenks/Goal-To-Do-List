<?php
$msgSucessoCadastro = isset($_GET['msgSucesso']) ? $_GET['msgSucesso'] : '';
$msgErroCadastro = isset($_GET['msgErro']) ? $_GET['msgErro'] : '';

require_once '../config/conectaDB.php';

$cardId = $_GET['id_card'];

$sql = "SELECT titulo, importancia, descricao, data_inicio, data_prazo, estado
        FROM cards
        WHERE id_card = :id_card";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_card' => $cardId]);
$card = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->bindParam(':id_card', $cardId, PDO::PARAM_INT);
$stmt->execute();

if (!$card) {
    echo "Card não encontrado!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do</title>
    <link rel="shortcut icon" href="../assets/escreva.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/adicionar.css">
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

        <p class="success-container">
            <?php
            if (!empty($msgSucessoCadastro)) {
                echo '<p class="success-msg">' . htmlspecialchars($msgSucessoCadastro) . '</p>';
            }
            ?>
        </p>

        <p class="error-container">
            <?php
            if (isset($_GET['msgErro'])) {
                echo '<p class="error-msg">' . $_GET['msgErro'] . '</p>';
            }
            ?>
        </p>

        <!--Cards-->
        <form action="../config/estados_card.php" method="POST">
            <input type="hidden" name="id_card" value="<?php echo $cardId; ?>">
            <div class="cards">
                <div class="topo">
                    <div id="input-titulo">
                        <label for="titulo">Título</label>
                        <input type="text" placeholder="Título:" maxlength="40" name="titulo"
                            value="<?php echo $card['titulo'] ?>" readonly>
                    </div>
                    <div class="importancia">
                        <label for="importancia">Importância</label>
                        <select name="importancia" id="">
                            <option value="<?php echo $card['importancia'] ?>" selected readonly>
                                <?php echo $card['importancia'] ?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="descricao">
                    <textarea name="descricao" id="" placeholder="Descrição:"
                        readonly><?php echo $card['descricao'] ?></textarea>
                </div>
                <div class="datas">
                    <div class="data_inicio">
                        <p>Data Inicio:</p>
                        <input type="date" name="data_inicio" value="<?php echo $card['data_inicio'] ?>" readonly>
                    </div>
                    <div class="data_prazo">
                        <p>Data Prazo:</p>
                        <input type="date" name="data_prazo" value="<?php echo $card['data_prazo'] ?>" readonly>
                    </div>
                </div>

            </div>
            <div class="buttons">
                <?php
                if ($card['estado'] == 1) {
                    echo '<button type="submit" name="acao" value="desativar" class="b-cancelar">Desativar</button>';
                    echo '<button type="submit" name="acao" value="feito" class="b-adicionar">Feito!</button>';
                }

                ?>
                <?php
                if ($card['estado'] == 3) {
                    echo '<button type="submit" name="acao" value="reativar" class="b-adicionar">Reativar Card!</button>';
                }
                ?>
            </div>
        </form>
    </main>
</body>

</html>