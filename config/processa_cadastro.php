<?php
require_once 'conectaDB.php';

date_default_timezone_set('America/Caracas');

if (!empty($_POST)) {
    try {
        $nome = trim($_POST['nome']);
        $sobrenome = trim($_POST['sobrenome']);
        $email = trim(strtolower($_POST['email']));
        $senha = trim($_POST['senha']);
        $confirm = trim($_POST['confirm-senha']);
        $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']); // Remove caracteres não numéricos

        $erros = [];

        // Validações
        if (strlen($nome) < 3 || strlen($sobrenome) < 3) {
            $erros[] = 'Nome ou Sobrenome muito pequenos.';
        }

        if (!isValidEmail($email)) {
            $erros[] = 'E-mail inválido.';
        }

        if (!validatePassword($senha)) {
            $erros[] = 'Senha fraca: Deve conter pelo menos 8 caracteres, uma letra maiúscula, uma letra minúscula, um número e um caractere especial.';
        }

        if ($confirm !== $senha) {
            $erros[] = 'As senhas devem ser iguais.';
        }

        if (!validateCPF($cpf)) {
            $erros[] = 'CPF inválido.';
        }

        // Verificar se há erros
        if (!empty($erros)) {
            $mensagens = implode('|', $erros); // Junta todas as mensagens com um delimitador
            header('Location: ../pages/cadastro.php?msgErro=' . urlencode($mensagens));
            exit();
        }

        // Verificar se o e-mail ou CPF já existe
        $sql_verifica = "SELECT * FROM usuarios WHERE email = :email OR cpf = :cpf";
        $stmt_verifica = $pdo->prepare($sql_verifica);
        $stmt_verifica->execute([':email' => $email, ':cpf' => $cpf]);
        $usuario_existente = $stmt_verifica->fetch();

        if ($usuario_existente) {
            header('Location: ../pages/cadastro.php?msgErro=E-mail ou CPF já cadastrado.');
            exit();
        }

        // Inserir o usuário no banco de dados
        $sql = "INSERT INTO usuarios (nome, sobrenome, email, cpf, senha, data_cadastro)
                VALUES (:nome, :sobrenome, :email, :cpf, :senha, :data_cadastro)";

        $stmt = $pdo->prepare($sql);
        $dados = [
            ':nome' => $nome,
            ':sobrenome' => $sobrenome,
            ':email' => $email,
            ':cpf' => $cpf,
            ':senha' => password_hash($senha, PASSWORD_DEFAULT),
            ':data_cadastro' => date('Y-m-d H:i:s')
        ];

        if ($stmt->execute($dados)) {
            header('Location: ../index.php?msgSucesso=Cadastro realizado com sucesso!');
            exit();
        } else {
            header('Location: ../pages/cadastro.php?msgErro=Falha ao cadastrar, tente novamente.');
            exit();
        }

    } catch (PDOException $e) {
        header('Location: ../pages/cadastro.php?msgErro=Erro: ' . $e->getMessage());
        exit();
    }
} else {
    header("Location: ../pages/cadastro.php?msgErro=Erro de Acesso.");
    exit();
}

// Função para validar o formato do CPF
function validateCPF($cpf)
{
    if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }

    return true;
}

function validatePassword($password)
{
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    return preg_match($pattern, $password);
}

function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
?>
