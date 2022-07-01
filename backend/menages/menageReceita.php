<?php
include_once ('C:/xampp/htdocs/culinariaRocha/db/db.php');

$id = "";
$name ="";

if(!empty($_GET["function"])){ $function = $_GET["function"]; }else {$function = "";}
if(!empty($_GET["id"])){ $id = addslashes($_GET["id"]); }else {$id = "";}
if(!empty($_GET["id_utilizador"])){ $id_utilizador = addslashes($_GET["id_utilizador"]); }else {$id_utilizador = "";}
/* if(!empty($_GET["name"])){ $name = $_GET["name"]; }else {$name = "";}
if(!empty($_GET["porcao"])){ $porcao = $_GET["porcao"]; }else {$porcao = "";}
if(!empty($_GET["tempo"])){ $tempo = $_GET["tempo"]; }else {$tempo = "";}
if(!empty($_GET["status"])){ $status = $_GET["status"]; }else {$status = "";}
if(!empty($_GET["modoPreparo"])){ $modoPreparo = $_GET["modoPreparo"]; }else {$modoPreparo = "";}
if(!empty($_GET["ingredientes"])){ $ingredientes = $_GET["ingredientes"]; }else {$ingredientes = "";}
if(!empty($_GET["dificuldade"])){ $dificuldade = $_GET["dificuldade"]; }else {$dificuldade = "";} */

switch($function){
    case 'adicionar':
    ?>
      <form action="" method="POST">
        <p><label>Nome da Receita</label>
            <input name="name" class="w3-input w3-border w3-round-large" autocomplete="off" required>
        </p>

        <p><label>Número de Porcões</label>
             <input name="porcao" class="w3-input w3-border w3-round-large" autocomplete="off" required>
        </p>

        <p><label>Tempo de preparo</label>
            <input name="tempo" class="w3-input w3-border w3-round-large" autocomplete="off" required>
        </p>

        <label>Status</label>

        <p><input class="w3-radio" type="radio" name="status" value="P" checked>
            <label> Pendente</label>
        </p>
        <p><input class="w3-radio" type="radio" name="status" value="D">
            <label> Divulgado</label>
        </p>

        <label>Dificuldade</label>

        <p><input class="w3-radio" type="radio" name="dificuldade" value="1">
            <label> Muito Fácil</label>
        </p>

        <p><input class="w3-radio" type="radio" name="dificuldade" value="2">
        <label> Fácil</label>
        </p>

        <p><input class="w3-radio" type="radio" name="dificuldade" value="3" checked>
        <label> Médio</label>
        </p>

        <p><input class="w3-radio" type="radio" name="dificuldade" value="4">
            <label> Difícil</label>
        </p>

        <p><input class="w3-radio" type="radio" name="dificuldade" value="1">
            <label> Muito Difícil</label>
        </p>
                
        <p><label>Modo de preparo</label>
            <textarea name="modoPreparo" class="w3-input w3-border w3-round-large" style="resize:none" autocomplete="off" required></textarea>
        </p>

        <p><label>Ingredientes</label>
            <textarea name="ingredientes" class="w3-input w3-border w3-round-large" style="resize:none" autocomplete="off" required></textarea>
        </p>
        <div class="w3-row-padding w3-center">
            <input type="submit" name="adicionar" value="Criar" class="w3-padding w3-margin-top w3-round-large w3-border-amber w3-white w3-hover-light-grey">
        </div>
     </form>
    <?php
        if(isset($_POST['adicionar'])) {
            if(isset($_POST['name']) && isset($_POST['porcao']) && isset($_POST['tempo']) && isset($_POST['dificuldade']) && isset($_POST['status'])  && isset($_POST['modoPreparo']) && isset($_POST['ingredientes']))
            {
                $name = addslashes($_POST['name']);
                $porcao = addslashes($_POST['porcao']);
                $tempo = addslashes($_POST['tempo']);
                $status = addslashes($_POST['status']);
                $dificuldade = addslashes($_POST['dificuldade']);
                $modoPreparo = addslashes($_POST['modoPreparo']);
                $ingredientes = addslashes($_POST['ingredientes']);
                
                if(!empty($_POST['name']) && !empty($_POST['porcao']) && !empty($_POST['tempo']) && !empty($_POST['dificuldade']) && !empty($_POST['status']) && !empty($_POST['modoPreparo']) && !empty($_POST['ingredientes'])){
                    $query = $con->prepare("INSERT INTO receita(nome, porcao, tempo, status, modo_preparo, ingredientes, dificuldade) VALUES(:n, :p, :t, :s, :m, :i, :d)");
                    $query->bindValue(":n", $name, PDO::PARAM_STR);
                    $query->bindValue(":p", $porcao, PDO::PARAM_STR);
                    $query->bindValue(":t", $tempo, PDO::PARAM_STR);
                    $query->bindValue(":s", $status, PDO::PARAM_STR);
                    $query->bindValue(":m", $modoPreparo, PDO::PARAM_STR);
                    $query->bindValue(":i", $ingredientes, PDO::PARAM_STR);
                    $query->bindValue(":d", $dificuldade, PDO::PARAM_STR);
                    $query->execute();

                    header('location: ?pag=2');
                    
                }else{echo "Preencha o compo!";}
            }
        }
        break;

    case "editar":
    $query = $con->prepare("SELECT * FROM receita WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);  
?>
      <form action="" method="POST">
        <?php     $value="";
        foreach ($result as $key => $value){
         }
        ?>
        <p><label>Nome da Receita</label>
            <input name="name" class="w3-input w3-border w3-round-large"  value= "<?php echo $value['nome']; ?>" autocomplete="off" required>
        </php>

        <p><label>Número de Porcões</label>
             <input name="porcao" class="w3-input w3-border w3-round-large" value="<?php echo $value['porcao']; ?>" autocomplete="off" required>
        </p>

        <p><label>Tempo de preparo</label>
            <input name="tempo" class="w3-input w3-border w3-round-large" value="<?php echo $value['tempo']; ?>" autocomplete="off" required>
        </p>

        <label>Status</label>

        <p><input class="w3-radio" type="radio" name="status" value="P" <?php echo ($value['status'] == 'P') ? 'checked' : ''; ?> required>
            <label> Pendente</label>
        </p>
        <p><input class="w3-radio" type="radio" name="status" value="D" <?php echo ($value['status'] == 'D') ? 'checked' : ''; ?> required>
            <label> Divulgado</label>
        </p>

        <label>Dificuldade</label>

        <p><input class="w3-radio" type="radio" name="dificuldade" value="1" <?php echo ($value['dificuldade'] == '1') ? 'checked' : ''; ?> required>
            <label> Muito Fácil</label>
        </p>

        <p><input class="w3-radio" type="radio" name="dificuldade" value="2" <?php echo ($value['dificuldade'] == '2')  ? 'checked' : ''; ?> required>
        <label> Fácil</label>
        </p>

        <p><input class="w3-radio" type="radio" name="dificuldade" value="3" <?php echo ($value['dificuldade'] == '3')  ? 'checked' : ''; ?> required>
        <label> Médio</label>
        </p>

        <p><input class="w3-radio" type="radio" name="dificuldade" value="4" <?php echo ($value['dificuldade'] == '4')  ? 'checked' : ''; ?> required>
            <label> Difícil</label>
        </p>

        <p><input class="w3-radio" type="radio" name="dificuldade" value="5" <?php echo ($value['dificuldade'] == '5')  ? 'checked' : ''; ?> required>
            <label> Muito Difícil</label>
        </p>
                
        <p><label>Modo de preparo</label>
            <textarea name="modoPreparo" class="w3-input w3-border w3-round-large" style="resize:none" autocomplete="off" required><?php echo $value['modo_preparo']; ?> </textarea>
        </p>

        <p><label>Ingredientes</label>
            <textarea name="ingredientes" class="w3-input w3-border w3-round-large" style="resize:none" autocomplete="off" required><?php echo $value['ingredientes']; ?> </textarea>
        </p>
        <div class="w3-row-padding w3-center">
            <input type="submit" name="editar" value="Aplicar" class="w3-padding w3-margin-top w3-round-large w3-border-amber w3-white w3-hover-light-grey">
        </div>
     </form>
<?php

?>
<?php
if(isset($_POST['editar'])) {
    if(isset($_GET['id']) && isset($_POST['name']) && isset($_POST['porcao']) && isset($_POST['tempo']) && isset($_POST['dificuldade']) && isset($_POST['status'])  && isset($_POST['modoPreparo']) && isset($_POST['ingredientes']))
    {
        $name = addslashes($_POST['name']);
        $porcao = addslashes($_POST['porcao']);
        $tempo = addslashes($_POST['tempo']);
        $status = addslashes($_POST['status']);
        $dificuldade = addslashes($_POST['dificuldade']);
        $modoPreparo = addslashes($_POST['modoPreparo']);
        $ingredientes = addslashes($_POST['ingredientes']);
        
        if(!empty($_POST['name']) && !empty($_POST['porcao']) && !empty($_POST['tempo']) && !empty($_POST['dificuldade']) && !empty($_POST['status']) && !empty($_POST['modoPreparo']) && !empty($_POST['ingredientes'])){
            $query = $con->prepare("UPDATE receita SET nome = :n, porcao = :p, tempo = :t, status = :s, modo_preparo = :m, ingredientes = :i, dificuldade = :d WHERE id = :id_receita");
            $query->bindValue(":n", $name, PDO::PARAM_STR);
            $query->bindValue(":p", $porcao, PDO::PARAM_STR);
            $query->bindValue(":t", $tempo, PDO::PARAM_STR);
            $query->bindValue(":s", $status, PDO::PARAM_STR);
            $query->bindValue(":m", $modoPreparo, PDO::PARAM_STR);
            $query->bindValue(":i", $ingredientes, PDO::PARAM_STR);
            $query->bindValue(":d", $dificuldade, PDO::PARAM_STR);
            $query->bindValue(":id_receita", $id, PDO::PARAM_STR);
            $query->execute();
            
            header('location: ?pag=2');
        }else{echo "Preencha o compo!";}
    }
}
    break;

    case 'eliminar':
        $id = addslashes($_GET['id']);
        if(!empty($id)){
            $query = $con->prepare("SELECT * FROM receita WHERE id = :id_receita");
            $query->bindValue(":id_receita", $id, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0) {
                $query = $con->prepare("DELETE FROM receita WHERE id = :id_receita");
                $query->bindValue(":id_receita", $id, PDO::PARAM_STR);
                $query->execute();

                header('location: ?pag=2');
            }else { echo "Receita não encontrada!";}
        }               
    break;

    default: echo "Função não encontrada!";
}
?>