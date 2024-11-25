<?php
require_once 'config.php';

try {

    $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
    $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = "SELECT id, nome_de_usuario, data_de_registro FROM tabela_login";
    $stmt = $connPdo->query($sql);

   
    $resultados = [];


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $resultados[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($resultados);
} catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
} finally {

    $connPdo = null;
}
?>
