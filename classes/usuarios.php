<?php
include_once 'C:\xampp\htdocs\culinariaRocha\db\db.php';
class Usuario extends DB
{

    public function cadastrar($name, $email, $pass)
    {

        //Verificar se já existe o email cadastrado
        $query = $this->connect()->prepare("SELECT id FROM utilizador WHERE email = :email");
        $query->bindValue(":email", $email, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            return false; //Cadastrado
        } else {
            //caso não exista, cadastrar
            $query = $this->connect()->prepare("INSERT INTO utilizador(nome, email, senha) VALUES (:nome, :email, :pass)");
            $query->bindValue(":nome", $name, PDO::PARAM_STR);
            $query->bindValue(":email", $email, PDO::PARAM_STR);
            $query->bindValue(":pass", md5($pass), PDO::PARAM_STR);
            $query->execute();

            return true;
        }

    }
    
    public function logar($email, $pass)
    {
        $query = $this->connect()->prepare("SELECT id, nivel FROM utilizador WHERE email = :email AND senha = :pass");
        $query->bindValue(":email", $email);
        $query->bindValue(":pass", md5($pass));
        $query->execute();

        if ($query->rowCount() > 0) {
            //Cadastrado
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['id_utilizador'] = $result['id'];
            $_SESSION['nivel'] = $result['nivel'];
            return true;
        } else {
            //caso não exista
            return false;
        }
    }

    public function delete($id_utilizador) 
    {
        $query = $this->connect()->prepare("DELETE FROM livro WHERE id = :id_utilizador");
        $query->bindValue(":id_utilizador",$id_utilizador, PDO::PARAM_STR);
        $query->execute();
    }

    public function setNome($nome, $id_utilizador)
    {
        //Verificar se já um utilizador com esse id
        $query = $this->connect()->prepare("SELECT id FROM utilizador WHERE id :id_utilizador");
        $query->bindValue(":id_utilizador",$id_utilizador, PDO::PARAM_STR);
        $query->execute();
        
        
        if ($query->rowCount() > 0) {
            //se existe 
            $query = $this->connect()->prepare("UPDATE categoria SET nome = :nome WHERE id = :id_utilizador");
            $query->bindValue(":nome", $nome, PDO::PARAM_STR);
            $query->bindValue(":$id_utilizador", $id_utilizador, PDO::PARAM_STR);
            $query->execute();
            
            return true; 
        } else {
            //caso não exista
            return false;
        }

    }

    public function setPass($id_utilizador, $newPass)
    {
        //Verificar se já um utilizador com esse id
        $query = $this->connect()->prepare("SELECT id FROM utilizador WHERE id :id_utilizador");
        $query->bindValue(":id_utilizador",$id_utilizador, PDO::PARAM_STR);
        $query->execute();
        
        
        if ($query->rowCount() > 0) {
            //se existe
            $query = $this->connect()->prepare("UPDATE utilizador SET senha = :pass WHERE id = :id_utilizador");
            $query->bindValue(":pass", $newPass, PDO::PARAM_STR);
            $query->bindValue(":$id_utilizador", $id_utilizador, PDO::PARAM_STR);
            $query->execute();
            
            return true; 
        } else {
            //caso não exista
            return false;
        }

    }
}