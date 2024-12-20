<?php
// Captura possíveis mensagens de sucesso ou erro passadas via URL através do método GET.
// As variáveis são inicializadas como strings vazias se não houver mensagens.
$msgSucessoCadastro = isset($_GET['msgSucesso']) ? $_GET['msgSucesso'] : '';
$msgErroCadastro = isset($_GET['msgErro']) ? $_GET['msgErro'] : '';
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
        <form action="../config/processa_card.php" method="POST">
            <div class="cards">
                <div class="topo">
                    <div id="input-titulo">
                        <label for="titulo">Título</label>
                        <input type="text" placeholder="Título:" maxlength="40" name="titulo">
                    </div>
                    <div class="importancia">
                        <label for="importancia">Importância</label>
                        <select name="importancia" id="">
                            <option value="" selected disabled>Selecione</option>
                            <option value="1">Quero fazer</option>
                            <option value="2">Obrigado a fazer</option>
                            <option value="3">Não quero fazer</option>
                        </select>
                    </div>
                </div>
                <div class="descricao">
                    <textarea name="descricao" id="" placeholder="Descrição:"></textarea>
                </div>
                <div class="datas">
                    <div class="data_inicio">
                        <p>Data Inicio:</p>
                        <input type="date" name="data_inicio">
                    </div>
                    <div class="data_prazo">
                        <p>Data Prazo:</p>
                        <input type="date" name="data_prazo">
                    </div>
                </div>

            </div>
            <div class="buttons">
                <button class="b-cancelar"><a href="./adicionar.php">Limpar</a></button>
                <button class="b-adicionar" type="submit">Adicionar</button>
            </div>
        </form>
    </main>
</body>

</html>