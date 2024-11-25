<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $dataNascimento = $_POST['data_de_nascimento'];
    $genero = $_POST['genero'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    try {
        
        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
        $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       
        $sqlCadastro = "INSERT INTO cadastro (nome_de_usuario, senha, data_de_nascimento, genero, telefone, email)
                        VALUES (:usuario, :senha, :dataNascimento, :genero, :telefone, :email)";
        $stmtCadastro = $connPdo->prepare($sqlCadastro);
        $stmtCadastro->bindParam(':usuario', $usuario);
        $stmtCadastro->bindParam(':senha', $senha);
        $stmtCadastro->bindParam(':dataNascimento', $dataNascimento);
        $stmtCadastro->bindParam(':genero', $genero);
        $stmtCadastro->bindParam(':telefone', $telefone);
        $stmtCadastro->bindParam(':email', $email);
        $stmtCadastro->execute();

        
        $sqlLogin = "INSERT INTO tabela_login (nome_de_usuario, senha)
                     VALUES (:usuario, :senha)";
        $stmtLogin = $connPdo->prepare($sqlLogin);
        $stmtLogin->bindParam(':usuario', $usuario);
        $stmtLogin->bindParam(':senha', $senha);
        $stmtLogin->execute();

        
        echo "Cadastro realizado com sucesso!";

  
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
