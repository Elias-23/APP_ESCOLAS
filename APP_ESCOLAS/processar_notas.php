<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $aluno = $_POST["aluno"];
    $materia = $_POST["materia"];
    $nota = $_POST["nota"];

    try {
       
        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
        $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       
        $stmt = $connPdo->prepare("INSERT INTO notas (aluno, materia, nota) VALUES (?, ?, ?)");

        
        $stmt->bindParam(1, $aluno);
        $stmt->bindParam(2, $materia);
        $stmt->bindParam(3, $nota);

      
        $stmt->execute();

        
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?success=1');
        exit(); 
    } catch (PDOException $e) {
        
        echo "Erro no banco de dados: " . $e->getMessage();
    } finally {
        
        $connPdo = null;
    }

    
    echo '<script>
        setTimeout(function() {
            window.location.href = "window.history.back";
        }, 2000);
    </script>';
}
?>
