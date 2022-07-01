<?php
class Categoria extends DB
{
    private $nome;
    private $link;

    public function __construct()
    {
        $this->nome = "";
        $this->link = "";
    }

    public function add($nome, $link)
    {
        //Verificar se já existe um ficheiro 
        $query = $this->connect()->prepare("SELECT id FROM livro WHERE nome :nome");
        $query->bindValue(":nome", $nome, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            return false; //se existe
        } else {
            //caso não exista
            $query = $this->connect()->prepare("INSERT INTO galeria(link, nome) VALUES (:link, :nome)");
            $query->bindValue(":link", $link, PDO::PARAM_STR);
            $query->bindValue(":nome", $nome, PDO::PARAM_STR);
            $query->execute();
            return true;
        }

    }

    public function delete($id_ficheiro)
    {
        $query = $this->connect()->prepare("DELETE FROM galeria WHERE id = :id_ficheiro");
        $query->bindValue(":id_ficheiro", $id_ficheiro, PDO::PARAM_STR);
        $query->execute();
    }

    public function getFicheiros()
    {
        $query = $this->connect()->prepare("SELECT * FROM galeria ORDER BY id DESC");
        $query->execute();
    }

}