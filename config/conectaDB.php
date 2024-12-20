<?php

$endereco = 'localhost';
$banco = 'to-do';
$usuario = 'postgres';
$senha = 'Rafha@123database';

try {
    $pdo = new PDO("pgsql:host=$endereco;port=5432;dbname=$banco", $usuario, $senha, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

} catch (PDOException $e) {
    echo "Falha ao conectar ao banco de dados. <br/>";
    die($e->getMessage());
}

?>