<?php

require_once 'config.php';

try {
  
    $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
    $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = "SELECT id, titulo, descricao FROM lembretes";
    $stmt = $connPdo->query($sql);

    $lembretes = [];


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $lembretes[] = $row;
    }


    header('Content-Type: application/json');
    echo json_encode($lembretes);
} catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
} finally {
   
    $connPdo = null;
}
?>
