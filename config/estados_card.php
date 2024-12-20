<?php
require_once 'conectaDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao'], $_POST['id_card'])) {

        $acao = $_POST['acao'];
        $id_card = $_POST['id_card'];

        try {
            $sql = '';
            if ($acao === 'feito') {
                $sql = "UPDATE cards SET estado = 2 WHERE id_card = :id_card";
            } elseif ($acao === 'desativar') {
                $sql = "UPDATE cards SET estado = 3 WHERE id_card = :id_card";
            } elseif ($acao === 'reativar') {
                $sql = "UPDATE cards SET estado = 1 WHERE id_card = :id_card";
            }

            if(!empty($sql)) {
                $stmt = $pdo->prepare($sql);
                $stmt -> execute([':id_card' => $id_card]);

                header("Location: ../pages/adicionar.php?msgSucesso=Card Atualizado com Sucesso!!");
                exit;
            } else {
                header ("Location: ../pages/adicionar.php?MsgErro= Não foi possível atualizar o card!");
            }
        } catch (PDOException $e) {
            header("Location: ../pages/adicionar.php?MsgErro= Erro ao atualizar o card: " . $e->getMessage());
        }
    } else {
        header ("Location: ../pages/adicionar.php?MsgErro= Você não clicou no botão");
    }
} else {
    header ("Location: ../pages/adicionar.php?MsgErro= Atualização de Card não foi enviada");
}
?>