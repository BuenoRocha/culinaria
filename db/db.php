<?php


try {
$con = new PDO('mysql:host=localhost;dbname=livraria', 'root', '');
} catch (PDOException $e) {
$msg = $e->getMessage();
}



class DB
{
    private $host;
    private $db;
    private $user;
    private $password;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->db = 'livraria';
        $this->user = 'root';
        $this->password = '';
        
    }

    public function connect()
    {

        try {
            /* $connection = "mysql:host=" . $this->host . ";dbname" . $this->db;*/

            $pdo = new PDO("mysql:host=localhost;dbname=livraria" , 'root' , '' );
            //PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (PDOException $e) {
            print_r("Error connection: " . $e->getMessage());
            
        }
    }

}