<?php
require_once 'config.php';

class Login
{
    public static function verificarLogin($dados)
    {
        $tabela = "tabela_login";
        $colunaLogin = "nome_de_usuario";
        $colunaSenha = "senha";

        try {
            $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
            $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id, nome_de_usuario, senha FROM $tabela WHERE $colunaLogin = :login";
            $stmt = $connPdo->prepare($sql);

            $stmt->bindValue(':login', $dados['usuario']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

               
                if (password_verify($dados['senha'], $usuario['senha'])) {
                    return $usuario;
                } else {
                    throw new Exception("Senha incorreta");
                }
            } else {
                throw new Exception("Login incorreto");
            }
        } catch (PDOException $e) {
            throw new Exception("Erro no banco de dados: " . $e->getMessage());
        } finally {
            
            $connPdo = null;
        }
    }
}
?>
