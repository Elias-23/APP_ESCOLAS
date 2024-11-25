<?php
require_once 'config.php';

try {
    $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
    $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $connPdo->query("SELECT nome_de_usuario FROM tabela_login");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

   
    header('Content-Type: application/json');
    echo json_encode($usuarios);
} catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
} finally {
    $connPdo = null;
}
?>
