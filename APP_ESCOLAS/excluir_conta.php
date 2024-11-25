<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    try {
        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
        $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stmt = $connPdo->prepare("SELECT * FROM usuarios WHERE nome_de_usuario = ? AND senha = ?");
        $stmt->bindParam(1, $usuario);
        $stmt->bindParam(2, $senha);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            
            $stmtDelete = $connPdo->prepare("DELETE FROM usuarios WHERE nome_de_usuario = ?");
            $stmtDelete->bindParam(1, $usuario);
            $stmtDelete->execute();

            $response = ['success' => true];
        } else {
            $response = ['success' => false, 'error' => 'Credenciais inválidas.'];
        }
    } catch (PDOException $e) {
        $response = ['success' => false, 'error' => 'Erro no banco de dados: ' . $e->getMessage()];
   
    echo '<script>
    setTimeout(function() {
        window.location.href = "pagina_inicial.html";
    }, 2000);
</script>';
} catch (PDOException $e) {
echo "Erro no banco de dados: " . $e->getMessage();
} finally {

$connPdo = null;
}
}
?>

