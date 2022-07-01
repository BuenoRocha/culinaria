<?php
include_once ('C:/xampp/htdocs/culinariaRocha/db/db.php');

$sql = "SELECT * FROM receita ORDER BY id DESC";
$cmd = $con->prepare($sql);
$cmd->execute();
$result = $cmd->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="w3-container w3-center">
    <h2>Tabela de Receitas</h2>
    <table class="w3-table-all w3-hoverable">
        <thead>
            <tr class="w3-black">
                <th>ID</th>
                <th>Nome</th>
                <th>Porção</th>
                <th>Tempo</th>
                <th>Status</th>
                <th>Dificuldade</th>
                <th>Modo de preparo</th>
                <th>Ingredientes</th>
                <th>Id utilizador</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <?php
            $value="";
            foreach ($result as $key => $value){
                switch ($value['dificuldade']) {
                    case '1':
                        $dificuldade = "Muito fácil";
                        break;
                    case '2':
                        $dificuldade = "Fácil";
                        break; 
                    case '3':
                        $dificuldade = "Médio";
                        break;
                   case '4':
                        $dificuldade = "Difícil";
                        break;
                    case '5':
                        $dificuldade = "Muito Difícil";
                        break;
                    default:
                        $dificuldade = "Médio";
                        break;
                }
                switch ($value['status']) {
                    case 'P':
                        $status = "Pendente";
                        break;
                    case 'D':
                        $status = "Publicado";
                        break; 
                    default:
                        $status = "Pendente";
                        break;
                }
                echo "<tr>";
                echo "<td>". $value['id']."</td>";
                echo "<td>". $value['nome']."</td>";
                echo "<td>". $value['porcao']."</td>";
                echo "<td>". $value['tempo']."</td>";
                echo "<td>". $status."</td>";
                echo "<td>". $dificuldade ."</td>";
                echo "<td>". $value['modo_preparo']."</td>";
                echo "<td>". $value['ingredientes']."</td>";
                echo "<td>". $value['id_utilizador']."</td>";
        ?>
        <td> <a href='?pag=7&id=<?php echo $value['id']?>&id_utilizador=<?php echo $_SESSION['id_utilizador']?>&function=editar' class='w3-button w3-small w3-padding w3-round-large w3-border-amber w3-blue w3-hover-light-grey'>Editar</a></td>
        <td> <a href='?pag=7&id=<?php echo $value['id']?>&id_utilizador=<?php echo $_SESSION['id_utilizador']?>&function=eliminar'  class='w3-button w3-small w3-padding w3-round-large w3-border-amber w3-red w3-hover-light-grey'>Eliminar</a></td>
        <?php
        }
        ?>
    </table>
</div>
<div class="w3-container w3-center" style="margin-top: 20px;">
    <a href='?pag=7&function=adicionar' class='w3-border-black w3-padding w3-round-large w3-white w3-hover-light-grey' style="width:50%; border:2px solid;">Adicionar Nova +</a>
</div>
