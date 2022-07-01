<?php

class Receita extends DB
{

    private $nome;
    private $porcao;
    private $tempo;
    private $status;
    private $modo_preparo;
    private $ingredientes;
    private $dificuldade;

    public function __construct()
    {
        $this->nome = "";
        $this->porcao = "";
        $this->tempo = "";
        $this->status = "";
        $this->modo_preparo = "";
        $this->ingredientes = "";
        $this->dificuldade = "";
    }

    public function add($nome, $porcao, $tempo, $modo_preparo, $status, $ingredientes, $dificuldade)
    {
        $query = $this->connect()->prepare("INSERT INTO receita(nome, porcao, tempo, status, modo_preparo, ingredientes, dificuldade) VALUES (:nome, :porcao, :tempo, :status, :modo_preparo, :ingredientes, :dificuldade)");
        $query->bindValue(":nome", $nome, PDO::PARAM_STR);
        $query->bindValue(":porcao", $porcao, PDO::PARAM_STR);
        $query->bindValue(":tempo", $tempo, PDO::PARAM_STR);
        $query->bindValue(":modo_preparo", $modo_preparo, PDO::PARAM_STR);
        $query->bindValue(":status", $status, PDO::PARAM_STR);
        $query->bindValue(":ingredientes", $ingredientes, PDO::PARAM_STR);
        $query->bindValue(":dificuldade", $dificuldade, PDO::PARAM_STR);
        $query->execute();

    }

    public function setReceita($nome, $porcao, $tempo, $modo_preparo, $status, $ingredientes, $dificuldade, $id_receita)
    {
        //Verificar se já existe uma receita com este id
        $query = $this->connect()->prepare("SELECT * FROM livro WHERE id :id_receita");
        $query->bindValue(":id_receita", $id_receita, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            //existe a receita
            $query = $this->connect()->prepare("UPDATE receita SET (nome = :nome, porcao = :porcao, tempo = :tempo, status = :status, modo_preparo = :modo_preparo, ingredientes = :ingredientes, dificuldade = :dificuldade) WHERE id = :id_receita");
            $query->bindValue(":nome", $nome, PDO::PARAM_STR);
            $query->bindValue(":porcao", $porcao, PDO::PARAM_STR);
            $query->bindValue(":tempo", $tempo, PDO::PARAM_STR);
            $query->bindValue(":modo_preparo", $modo_preparo, PDO::PARAM_STR);
            $query->bindValue(":status", $status, PDO::PARAM_STR);
            $query->bindValue(":ingredientes", $ingredientes, PDO::PARAM_STR);
            $query->bindValue(":dificuldade", $dificuldade, PDO::PARAM_STR);
            $query->bindValue(":id_receita", $id_receita, PDO::PARAM_STR);
            $query->execute();
            return true;
        } else {
            //caso não exista
            return false;
        }
    }

    public function delete($id_receita)
    {
        $query = $this->connect()->prepare("DELETE FROM receita WHERE id = :id_receita");
        $query->bindValue(":id_receita", $id_receita, PDO::PARAM_STR);
        $query->execute();
    }

    public function getReceite()
    {
        $query = $this->connect()->prepare("SELECT * FROM receita ORDER BY id DESC");
        $query->execute();
    }
}