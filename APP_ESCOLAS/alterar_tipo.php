<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $novoTipo = $_POST['tipo'];

    try {
        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
        $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Atualizar o tipo do usuário na tabela_login
        $stmt = $connPdo->prepare("UPDATE tabela_login SET tipo_usuario = :novoTipo WHERE nome_de_usuario = :usuario");
        $stmt->bindParam(':novoTipo', $novoTipo);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        echo "Tipo de usuário alterado com sucesso!";

        
        echo "<script>window.history.go(-1);</script>";
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();

       
        echo '<script>
            setTimeout(function() {
                window.history.back();
            }, 2000);
        </script>';
    } finally {
        
        $connPdo = null;
    }
}
?>
