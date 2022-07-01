<?php
include_once 'C:/xampp/htdocs/culinariaRocha/db/db.php';

?>
<form action="" method="POST">
    <p>
        <label>Email</label>
        <input name="email" class="w3-input w3-border w3-round-large">
    </p>
    <p>
        <label>Senha</label>
        <input name="pass" type="password" class="w3-input w3-border w3-round-large">
    </p>
    <div class="w3-row-padding w3-padding-16">
        <input type="submit" value="Login" name="logar" class="w3-button w3-white w3-round w3-border w3-round-large">
        <a href="?id=3">Criar conta</a>
    </div>
</form>
<?php
if (isset($_POST["logar"])) {
    if (isset($_POST['email']) && isset($_POST['pass'])) {
        $email = addslashes($_POST['email']);
        $pass = addslashes($_POST['pass']);

        if (!empty($email) && !empty($pass)) {
            $query = $con->prepare("SELECT id, nivel FROM utilizador WHERE email = :email AND senha = :pass");
            $query->bindValue(":email", $email);
            $query->bindValue(":pass", md5($pass));
            $query->execute();

            if ($query->rowCount() > 0) {
                //Cadastrado
                $result = $query->fetch(PDO::FETCH_ASSOC);

                $_SESSION['id_utilizador'] = $result['id'];
                $_SESSION['nivel'] = $result['nivel'];

                if ($result['nivel'] == 'E' or $result['nivel'] == 'M') {
                    header('location: backend/');
                }
                echo "Utilizador logado!";
            } else {
                echo "Não foi encontrado nenhum utilizador com este email ou senha!";
            }
        } else {echo "Preencha todos os compos!";}
    } else {

    }
}
?>
