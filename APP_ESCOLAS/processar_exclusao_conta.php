<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    try {
        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
        $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stmt = $connPdo->prepare("SELECT * FROM usuarios WHERE usuario = ? AND senha = ?");
        $stmt->bindParam(1, $usuario);
        $stmt->bindParam(2, $senha);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
           
            $stmtExcluir = $connPdo->prepare("DELETE FROM usuarios WHERE usuario = ?");
            $stmtExcluir->bindParam(1, $usuario);
            $stmtExcluir->execute();

          
            $response = ['success' => true, 'message' => 'Conta excluída com sucesso.'];
        } else {
            $response = ['success' => false, 'error' => 'Usuário ou senha incorretos.'];
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

