<?php
require_once 'conectaDB.php';

if (!empty($_POST)) {

    session_start();

    try {

        $sql = "SELECT nome, sobrenome, email, senha, cpf FROM usuarios  WHERE LOWER(email) = LOWER(:email)";

        $stmt = $pdo->prepare($sql);

        $dados = array(
            ':email' => strtolower($_POST['email'])
        );

        $stmt->execute($dados);
        $result = $stmt->fetch();

        if ($result && password_verify($_POST['senha'], $result['senha'])) {
            $_SESSION['nome'] = $result['nome'];
            $_SESSION['sobrenome'] = $result['sobrenome'];
            $_SESSION['cpf'] = $result['cpf'];
            $_SESSION['email'] = $result['email'];

            header("Location: ../pages/adicionar.php");
        } elseif (!$result) {
            session_destroy();
            header("Location: ../index.php?msgErro= Email não cadastrado.");
            exit();
        } else {
            session_destroy();
            header("Location: ../index.php?msgErro= Email e/ou Senha Inválido(s).");
            exit();
        }


    } catch (PDOException $e) {
        die($e->getMessage());
    }
    ;
} else {
    header("Location: ../index.php?msgErro=Você não tem permissão para acessar esta página.");
    exit();
}

?>