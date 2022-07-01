<?php
include_once ('C:/xampp/htdocs/culinariaRocha/db/db.php');

$id = "";
$name ="";
if(!empty($_GET["function"])){
    $function = $_GET["function"];
    }else {$function = "";}

if(!empty($_GET["id"])){
    $id = addslashes($_GET["id"]);
    }else {$id = "";}

if(!empty($_GET["name"])){
    $name = addslashes($_GET["name"]);
    }else {$name = "";}
    
echo $function . "---";
echo $id . "---";
echo $name . "---";
switch($function){
    case 'email':
    ?>
    <form action="" method="POST" >
        <p>
            <label for="name">Novo Email</label>
            <input id="name" name="emailEdit" class="w3-input w3-border w3-round-large" autocomplete="off" required>
        </p>
        <div class="w3-row-padding w3-center">
            <input type="submit" name="trocarE" value="Editar" class="w3-padding w3-margin-top w3-round-large w3-border-amber w3-white w3-hover-light-grey">
        </div>
    </form>
    
    <?php
        if(isset($_POST['trocarE'])) {
            if( isset($_POST['emailEdit']))
            {
                $email = addslashes($_POST['emailEdit']);
                if(!empty($name)){
                    //Verificar se já existe um email
                    $query = $con->prepare("SELECT id FROM utilizador WHERE email = :email");
                    $query->bindValue(":email", $email, PDO::PARAM_STR);
                    $query->execute();
                    
                    
                    if ($query->rowCount() > 0) {
                        //existe o categoria
                        echo "já existe uma conta criada com esse email!";
                    } else {
                        //caso não exista
                        $query = $con->prepare("UPDATE utilizador SET email :email WHERE id = :id_utilizador");
                        $query->bindValue(":id_utilizador", $id, PDO::PARAM_STR);
                        $query->bindValue(":email", $email, PDO::PARAM_STR);
                        $query->execute();
                        
                    echo "Email editado!";
                    }
                }else{echo "Preencha o compo!";}
            }else{}
        }
        break;

    case "senha":
    ?>
       <form action="" method="POST" >
       <p>
            <label for="name">Senha atual</label>
            <input id="name" name="senha" class="w3-input w3-border w3-round-large" autocomplete="off" required>
        </p>
        <p>
            <label for="name">Nova Senha</label>
            <input id="name" name="senhaEdit" class="w3-input w3-border w3-round-large" autocomplete="off" required>
        </p>
        <div class="w3-row-padding w3-center">
            <input type="submit" name="trocarS" value="Editar" class="w3-padding w3-margin-top w3-round-large w3-border-amber w3-white w3-hover-light-grey">
        </div>
    </form>
        <?php
        if(isset($_POST['trocarS'])) {
            if(isset($_GET['id']) && isset($_POST['senha']) && isset($_POST['senhaEdit']))
            {
                $senha = addslashes($_POST['senha']);
                $senhaEdit = addslashes($_POST['senhaEdit']);
                if(!empty($id) && !empty($name)){
                    //Verificar se já existe uma categoria
                    $query = $con->prepare("SELECT senha FROM utilizador WHERE id = :id_utilizador");
                    $query->bindValue(":id_utilizador", $id, PDO::PARAM_STR);
                    $query->bindValue(":senha", md5($senha), PDO::PARAM_STR);
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_ASSOC);
                                                      
                    if ($query->rowCount() > 0) {
                        //existe o utilizador
                        if($result == $senha){
                            $query = $con->prepare("UPDATE utilizador SET senha = :senha WHERE id = :id_utilizador");
                            $query->bindValue(":senha", md5($senha), PDO::PARAM_STR);
                            $query->bindValue(":id_utilizador", $id, PDO::PARAM_STR);
                            $query->execute();
                            
                           echo "Senha editada!";
                        }else{ echo "Senha atual incorreta!";}
                    } else {
                        //caso não exista
                        echo "Utilizador não encontrado!";
                    }
                }else{echo "Preencha o compo!";}
            }else{}
        }
    break;

    case 'nome':
        ?>
        <form action="" method="POST" >
            <p>
                <label for="name">Novo Nome</label>
                <input id="name" name="nameEdit" class="w3-input w3-border w3-round-large" autocomplete="off" required>
            </p>
            <div class="w3-row-padding w3-center">
                <input type="submit" name="trocarN" value="Editar" class="w3-padding w3-margin-top w3-round-large w3-border-amber w3-white w3-hover-light-grey">
            </div>
        </form>
        <?php
        if(isset($_POST['trocarN'])) {
            if( isset($_POST['nameEdit']))
            {
                $name = addslashes($_POST['nameEdit']);
                if(!empty($name)){
                    //Verificar se existe um utilizador
                    $query = $con->prepare("SELECT * FROM utilizador WHERE id = :id_utilizador");
                    $query->bindValue(":id_utilizador", $id, PDO::PARAM_STR);
                    $query->execute();
                          
                    if ($query->rowCount() > 0) {
                        //existe o utilizador
                        $query = $con->prepare("UPDATE utilizador SET nome :nome WHERE id = :id_utilizador");
                        $query->bindValue(":id_utilizador", $id, PDO::PARAM_STR);
                        $query->bindValue(":nome", $name, PDO::PARAM_STR);
                        $query->execute();

                        echo "Nome alterado!";
                    } else {
                    echo "Utilizador não encontrado!";
                    }
                }else{echo "Preencha o compo!";}
            }else{}
        }             
    break;

    
    case 'deletar':
        if(!empty($id)){
            $query = $con->prepare("SELECT * FROM utilizador WHERE id = :id_utilizador");
            $query->bindValue(":id_utilizador",$id, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0) {
                $query = $con->prepare("DELETE FROM utilizador WHERE id = :id_utilizador");
                $query->bindValue(":id_utilizador", $id, PDO::PARAM_STR);
                $query->execute();
                echo "Utilizador Eliminado!";
                unset($_SESSION['id_utilizador']);
                unset($_SESSION['nivel']);
                session_destroy();
                header("location: ../../");
            }else { echo "Utilizador não encontrado!";}
        }               
    break;

    default: echo "Erro na função requisitada!";
}
?>