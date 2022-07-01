<?php
include_once ('C:/xampp/htdocs/culinariaRocha/db/db.php');

$sql = "SELECT * FROM utilizador ORDER BY id DESC";
$cmd = $con->prepare($sql);
$cmd->execute();
$result = $cmd->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="w3-container w3-center">
    <h2>Tabela de Utilizadores</h2>
    <table class="w3-table-all w3-hoverable">
        <thead>
            <tr class="w3-black">
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Nível</th>
                <th>Data</th>
                <th>Senha</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($result as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $value['id'] . "</td>";
                    echo "<td>" . $value['nome'] . "</td>";
                    echo "<td>" . $value['email'] . "</td>";
                    echo "<td>" . $value['nivel'] . "</td>";
                    echo "<td>" . $value['data'] . "</td>";
                    echo "<td>" . $value['senha'] . "</td>";
                    ?>
                    <td> <a href='?pag=9&id=<?php echo $value['id']?>&name=<?php echo $value['nome']?>&function=editar' class='w3-button w3-small w3-padding w3-round-large w3-border-amber w3-blue w3-hover-light-grey'>Editar</a></td>
                    <td> <a href='?pag=9&id=<?php echo $value['id']?>&name=<?php echo $value['nome']?>&function=eliminar' class='w3-button w3-small w3-padding w3-round-large w3-border-amber w3-red w3-hover-light-grey'>Eliminar</a></td>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>
<div class="w3-container w3-center" style="margin-top: 20px;">
    <a href='?pag=9&function=adicionar' class='w3-border-black w3-padding w3-round-large w3-white w3-hover-light-grey' style="width:50%; border:2px solid;">Adicionar Nova +</a>
</div>

<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-4" style="max-width: 70%">
        <header class="w3-container w3-black">
            <span onclick="document.getElementById('id01').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <h2>Nova Usuário</h2>
        </header>
        <div class="w3-container">
            <form id="form" method="POST">
                <p><label for="name">Nome do Usuário</label>
                    <input id="name" name="name" class="w3-input w3-border w3-round-large">
                </p>

                <p><label for="email">Email</label>
                    <input id="email" name="email" class="w3-input w3-border w3-round-large">
                </p>

                <p><label for="nivel">Nível</label>
                    <select id="nivel" class="w3-select" name="option">
                        <option name="utilizador" value="U" selected>Utilizador</option>
                        <option name="edtor" value="E">Editor</option>
                    </select>
                </p>

                <p><label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" class="w3-input w3-border w3-round-large">
                </p>
                <div class="w3-row-padding w3-center">
                    <button type="submit" name="btn-criar"
                        class="w3-padding w3-margin-top w3-round-large w3-border-amber w3-white w3-hover-light-grey">Criar</button>
                </div>
            </form>
        </div>
        <footer class="w3-container w3-black">
        </footer>
    </div>
</div>

<script type="text/javascript">
$(function() {
    $('#form').submit(function() {
        $.ajax({
            url: 'classes/utilizador.class.php',
            type: 'POST',
            data: $('#form').serialize(),
            success: function(data) {}
        }).done(function(result) {
            $('#name').val('');
            $('#email').val('');
            $('#nivel').val('');
            $('#senha').val('');
        })
        return false;
    })
})
</script>
<script type="text/javascript" src="script.js"></script>