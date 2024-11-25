<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $novaSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    try {
        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
        $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stmt = $connPdo->prepare("SELECT * FROM tabela_login WHERE nome_de_usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
         
            $stmt = $connPdo->prepare("UPDATE tabela_login SET senha = :novaSenha WHERE nome_de_usuario = :usuario");
            $stmt->bindParam(':novaSenha', $novaSenha);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Senha redefinida com sucesso!";
            } else {
                echo "Erro ao redefinir a senha. Tente novamente mais tarde.";
            }
        } else {
            echo "Usuário não encontrado. Verifique o nome de usuário e tente novamente.";
        }
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
   
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

