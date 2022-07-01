<?php
include_once ('C:/xampp/htdocs/culinariaRocha/db/db.php');

$sql = "SELECT * FROM categoria ORDER BY id DESC";
$cmd = $con->prepare($sql);
$cmd->execute();
$result = $cmd->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="w3-container w3-center">
    <h2>Tabela de Categorias</h2>
    <table class="w3-table-all w3-hoverable">
        <thead>
            <tr class="w3-black">
                <th>ID</th>
                <th>Nome</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $value="";
                foreach ($result as $key => $value){
                    echo "<tr>";
                    echo "<td>". $value['id']."</td>";
                    echo "<td>". $value['nome']."</td>";
                    ?>
                    <td> <a href='?pag=6&id=<?php echo $value['id']?>&name=<?php echo $value['nome']?>&function=editar' class='w3-button w3-small w3-padding w3-round-large w3-border-amber w3-blue w3-hover-light-grey'>Editar</a></td>
                    <td> <a href='?pag=6&id=<?php echo $value['id']?>&name=<?php echo $value['nome']?>&function=eliminar' class='w3-button w3-small w3-padding w3-round-large w3-border-amber w3-red w3-hover-light-grey'>Eliminar</a></td>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>
<div class="w3-container w3-center" style="margin-top: 20px;">
    <a href='?pag=6&function=adicionar' class='w3-border-black w3-padding w3-round-large w3-white w3-hover-light-grey' style="width:50%; border:2px solid;">Adicionar Nova +</a>
</div>

