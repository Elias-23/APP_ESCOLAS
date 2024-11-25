<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $id_usuario = 1; 

    try {
        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
        $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      
        $stmt = $connPdo->prepare("INSERT INTO lembretes (id_usuario, titulo, descricao) VALUES (:id_usuario, :titulo, :descricao)");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->execute();

        echo "Lembrete criado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
    } finally {

        $connPdo = null;
    }

 
    echo '<script>
        setTimeout(function() {
            window.history.back();
        }, 2000);
    </script>';
}
?>
