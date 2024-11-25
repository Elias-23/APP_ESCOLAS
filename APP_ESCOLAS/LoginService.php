<?php


require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    try {
        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
        $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stmt = $connPdo->prepare("SELECT id, nome_de_usuario, senha, tipo_usuario FROM tabela_login WHERE nome_de_usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

     
        if ($user && password_verify($senha, $user['senha'])) {
       
            echo "Login bem-sucedido! Bem-vindo, {$user['nome_de_usuario']}!";

           
            switch ($user['tipo_usuario']) {
                case 'Gestao':
                    header("Location: gestão.html");
                    break;
                case 'Professor':
                    header("Location: professor.html");
                    break;
                case 'Aluno':
                    header("Location: aluno.html");
                    break;
                default:
                  
                    header("Location: pagina_inicial.html");
            }
        } else {
           
            echo "Usuário ou senha inválidos. Tente novamente.";
            echo '<script>alert("Usuário ou senha inválidos. Tente novamente.");</script>';
            echo '<script>window.history.back();</script>'; 
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

