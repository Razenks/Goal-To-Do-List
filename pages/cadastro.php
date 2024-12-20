<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="shortcut icon" href="../assets/escreva.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/cadastro.css">
    <script src="../js/cadastro.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>

<body>
    <form action="../config/processa_cadastro.php" method="POST">
        <h1 id="titulo">Cadastro</h1>
        <?php
        if (isset($_GET['msgErro'])) {
            $erros = explode('|', $_GET['msgErro']); // Divide a string pelo delimitador
            echo '<p class="error-container">';
            foreach ($erros as $erro) {
                echo '<p class="error-msg">' . htmlspecialchars($erro) . '</p>';
            }
            echo '</p>';
        }
        ?>

        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" required>
        </div>

        <div>
            <label for="sobrenome">Sobrenome</label>
            <input type="text" name="sobrenome" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" maxlength="14" required>
        </div>

        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" required>
        </div>

        <div>
            <label for="confirm-senha">Confirmar Senha</label>
            <input type="password" name="confirm-senha" required>
        </div>
        <button type="submit">Cadastrar</button>

        <button><a href="../index.php">Voltar</a></button>
    </form>
</body>

</html>