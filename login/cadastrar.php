<?php
include_once ('C:/xampp/htdocs/culinariaRocha/db/db.php');
?>
<form action="" method="POST">
<p>
        <label>Nome</label>
        <input name="name" class="w3-input w3-border w3-round-large" autocomplete="off" required>
    </p>
    <p>
        <label>Email</label>
        <input name="email" class="w3-input w3-border w3-round-large" autocomplete="off" required>
   </p>
   <p>
        <label>Senha</label>
        <input name="pass" type="password" class="w3-input w3-border w3-round-large" autocomplete="off" required>
     </p>
     <p>
        <label>Confirmar Senha</label>
        <input name="confPass" type="password" class="w3-input w3-border w3-round-large" autocomplete="off" required>
     </p>
    <div class="w3-row-padding w3-padding-16">
        <input type="submit" value="Criar conta" name="criar" class="w3-button w3-white w3-round w3-border w3-round-large">
        <a href="?id=2"> Logar</a>
    </div>
</form>
<?php
if (isset($_POST["criar"])){
    if(isset($_POST['name']) and isset($_POST['email']) and isset($_POST['pass']) and isset($_POST['confPass']) )
    {
        $name = addslashes($_POST['name']);
        $email = addslashes($_POST['email']);
        $pass = addslashes($_POST['pass']);
        $confPass = addslashes($_POST['confPass']);
        if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['confPass'])){
            if($pass == $confPass) {
            //Verificar se já existe o email cadastrado
            $query = $con->prepare("SELECT id FROM utilizador WHERE email = :email");
            $query->bindValue(":email", $email, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0) {
                echo "Já existe um email cadastrado com esse email";
                } else {
                    //caso não exista, cadastrar
                    $query = $con->prepare("INSERT INTO utilizador(nome, email, senha) VALUES (:nome, :email, :pass)");
                    $query->bindValue(":nome", $name, PDO::PARAM_STR);
                    $query->bindValue(":email", $email, PDO::PARAM_STR);
                    $query->bindValue(":pass", md5($pass), PDO::PARAM_STR);
                    $query->execute();
                    echo "Conta cadastrada!";
                    header('location: login/logar.php');
                }
            }else{ echo "Senha e confirmar senha não correspondem!";}
        }else{ echo "Preencha todos os compos!";}
    }else{
      
    }
}
?>
