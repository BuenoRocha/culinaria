<?php

class Livro extends DB 
{
    private $nome;

    public function __construct()
    {
        $this->nome = "";
    }

    public function add($nome, $id_utilizador)
    {
        //Verificar se já existe um livro com este nome
        $query = $this->connect()->prepare("SELECT id FROM livro WHERE nome :nome");
        $query->bindValue(":nome", $nome, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            return false; //se existe
        } else {
            //caso não exista
            $query = $this->connect()->prepare("INSERT INTO livro(nome, id_utilizador) VALUES (:nome, :id_utilizador)");
            $query->bindValue(":nome", $nome, PDO::PARAM_STR);
            $query->bindValue(":id_utilizador", $id_utilizador, PDO::PARAM_STR);
            $query->execute();
            return true;
        }

    }

    public function setLivro($nome, $id_livro)
    {
        //Verificar se já existe o livro
        $query = $this->connect()->prepare("SELECT id FROM livro WHERE nome :nome");
        $query->bindValue(":nome", $nome, PDO::PARAM_STR);
        $query->execute();
        
        
        if ($query->rowCount() > 0) {
            //existe o livro
            $query = $this->connect()->prepare("UPDATE livro SET nome = :nome WHERE id = :id_livro");
            $query->bindValue(":nome", $nome, PDO::PARAM_STR);
            $query->bindValue(":id_livro", $id_livro, PDO::PARAM_STR);
            $query->execute();
            
            return true; 
        } else {
            //caso não exista
            return false;
        }

    }

    public function delete($id_livro){
        
        $query = $this->connect()->prepare("DELETE FROM livro WHERE id = :id_livro");
        $query->bindValue(":id_livro", $id_livro, PDO::PARAM_STR);
        $query->execute();
    }

    public function getLivro(){
        $query = $this->connect()->prepare("SELECT * FROM livro ORDER BY id DESC");
        $query->execute();
    }

    public function getNota(){
        $query = $this->connect()->prepare("SELECT * FROM livro_livro");
        $query->execute();
    }
    
    public function setNota($id_livro, $id_receita, $nota){
        $query = $this->connect()->prepare("UPDATE livro_receita SET nota = :nota WHERE id _livro = :id_livro AND id_receita = :id_receita");
        $query->bindValue(":id_livro", $id_livro, PDO::PARAM_STR);
        $query->bindValue(":id_receita", $id_receita, PDO::PARAM_STR);
        $query->bindValue(":nota", $nota, PDO::PARAM_STR);
        $query->execute();
    }
}