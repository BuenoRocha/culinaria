<?php
include_once ('C:/xampp/htdocs/culinariaRocha/db/db.php');

$id = "";
$name ="";
if(!empty($_GET["function"])){
    $function = $_GET["function"];
    }else {$function = "";}

if(!empty($_GET["id"])){
    $id = $_GET["id"];
    }else {$id = "";}

if(!empty($_GET["name"])){
    $name = $_GET["name"];
    }else {$name = "";}
    
echo $function . "---";
echo $id . "---";
echo $name . "---";
switch($function){
    case 'adicionar':
    ?>
    <form action="" method="POST" >
        <p>
            <label for="name">Nome da Categoria</label>
            <input id="name" name="name" class="w3-input w3-border w3-round-large" autocomplete="off" required>
        </p>
        <div class="w3-row-padding w3-center">
            <input type="submit" name="adicionar" value="Adicionar" class="w3-padding w3-margin-top w3-round-large w3-border-amber w3-white w3-hover-light-grey">
        </div>
    </form>
    
    <?php
        if(isset($_POST['adicionar'])) {
            if( isset($_POST['name']))
            {
                $name = addslashes($_POST['name']);
                if(!empty($name)){
                    //Verificar se já existe uma categoria
                    $query = $con->prepare("SELECT id FROM categoria WHERE nome = :nome");
                    $query->bindValue(":nome", $name, PDO::PARAM_STR);
                    $query->execute();
                    
                    
                    if ($query->rowCount() > 0) {
                        //existe o categoria
                        echo "Esta categoria já existe!";
                    } else {
                        //caso não exista
                        $query = $con->prepare("INSERT INTO categoria(nome) VALUES(:nome)");
                        $query->bindValue(":nome", $name, PDO::PARAM_STR);
                        $query->execute();
                        
                        header('location: ?pag=1');
                    }
                }else{echo "Preencha o compo!";}
            }else{}
        }
        break;

    case "editar":
    ?>
    <form action="" method="POST" >
        <p>
            <label for="name">Novo nome da Categoria</label>
            <input id="name" name="nameEdit" value="<?php echo $name;?>" class="w3-input w3-border w3-round-large" autocomplete="off" required>
        </p>
        <div class="w3-row-padding w3-center">
            <input type="submit" name="editar" value="Editar" class="w3-padding w3-margin-top w3-round-large w3-border-amber w3-white w3-hover-light-grey">
        </div>
    </form>
        <?php
        if(isset($_POST['editar'])) {
            if(isset($_GET['id']) && isset($_POST['nameEdit']))
            {
                $id = addslashes($_GET['id']);
                $name = addslashes($_POST['nameEdit']);
                if(!empty($id) && !empty($name)){
                    //Verificar se já existe uma categoria
                    $query = $con->prepare("SELECT * FROM categoria WHERE id = :id_categoria");
                    $query->bindValue(":id_categoria",$id, PDO::PARAM_STR);
                    $query->execute();
                    
                    
                    if ($query->rowCount() > 0) {
                        //existe o categoria
                        $query = $con->prepare("UPDATE categoria SET nome = :nome WHERE id = :id_categoria");
                        $query->bindValue(":nome", $name, PDO::PARAM_STR);
                        $query->bindValue(":id_categoria", $id, PDO::PARAM_STR);
                        $query->execute();
                        
                        header('location: ?pag=1');
                    } else {
                        //caso não exista
                        echo "Categoria não encontrada!";
                    }
                }else{echo "Preencha o compo!";}
            }else{}
        }
    break;

    case 'eliminar':
        $id = addslashes($_GET['id']);
        if(!empty($id)){
            $query = $con->prepare("SELECT * FROM categoria WHERE id = :id_categoria");
            $query->bindValue(":id_categoria",$id, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0) {
                $query = $con->prepare("DELETE FROM categoria WHERE id = :id_categoria");
                $query->bindValue(":id_categoria", $id, PDO::PARAM_STR);
                $query->execute();

                header('location: ?pag=1');
            }else { echo "Categoria não encontrada!";}
        }               
    break;

    default: echo "Não funcionou!";
}
?>