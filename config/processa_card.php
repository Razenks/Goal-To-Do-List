<?php
    require_once 'conectaDB.php';

    if(!empty($_POST)) {
        session_start();

        try {
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $importancia = $_POST['importancia'];
            $data_inicio = $_POST['data_inicio'];
            $data_prazo = $_POST['data_prazo'];

            $sql = "INSERT INTO cards (cpf, titulo, descricao, data_inicio, data_prazo, estado, importancia)
                    VALUES (:cpf, :titulo, :descricao, :data_inicio, :data_prazo, :estado, :importancia)";

            $stmt = $pdo->prepare($sql);

            $dados = [
                ':cpf' => $_SESSION['cpf'],
                ':titulo' => $titulo,
                ':descricao' => $descricao,
                ':data_inicio' => $data_inicio,
                ':data_prazo' => $data_prazo,
                ':estado' => 1,
                ':importancia' => $importancia
            ];

            if($stmt->execute($dados)) {
                header('Location: ../pages/adicionar.php?MsgSucesso=Card cadastrado com sucesso!w');
                exit();
            } else {
                header('Location: ../pags/adicionar.php?MsgErro= Falha ao cadastrar um Card');
            }
        } catch (PDOException $e) {

        }
    }
?>