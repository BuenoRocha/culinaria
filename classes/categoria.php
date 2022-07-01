<?php

include_once 'C:\xampp\htdocs\culinariaRocha\db\db.php';

class Categoria extends DB 
{
    private $nome;

    public function __construct()
    {
        $this->nome = "";
    }

    public function add($nome)
    {
        //Verificar se já existe uma categoria 
        $query = $this->connect()->prepare("SELECT id FROM categoria WHERE nome = :nome");
        $query->bindValue(":nome", $nome, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            return false; //Existe já uma Categoria com esse nome
        } else {
            //caso não exista
            $query = $this->connect()->prepare("INSERT INTO categoria(nome) VALUES (:nome)");
            $query->bindValue(":nome", $nome, PDO::PARAM_STR);
            $query->execute();
            return true;
        }

    }

    public function setCategoria($nome, $id_categoria)
    {
        //Verificar se já existe uma categoria
        $query = $this->connect()->prepare("SELECT id FROM categoria WHERE nome = :nome");
        $query->bindValue(":nome", $nome, PDO::PARAM_STR);
        $query->execute();
        
        
        if ($query->rowCount() > 0) {
            //existe o categoria
            $query = $this->connect()->prepare("UPDATE categoria SET nome = :nome WHERE id = :id_categoria");
            $query->bindValue(":nome", $nome, PDO::PARAM_STR);
            $query->bindValue(":id_categoria", $id_categoria, PDO::PARAM_STR);
            $query->execute();
            
            return true; 
        } else {
            //caso não exista
            return false;
        }

    }

    public function delete($id_categoria){
        
        $query = $this->connect()->prepare("DELETE FROM categoria WHERE id = :id_categoria");
        $query->bindValue(":id_categoria", $id_categoria, PDO::PARAM_STR);
        $query->execute();
    }

    public function getCategoria(){
        $query = $this->connect()->prepare("SELECT * FROM categoria");
        $query->execute();
        return $query->fetchAll();
    }

    public function getNome($id_categoria){
        $query = $this->connect()->prepare("SELECT nome FROM categoria where id = :id_categoria");
        $query->bindValue(":id", $id_categoria, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }

}