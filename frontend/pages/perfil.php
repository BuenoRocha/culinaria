<?php
include_once ('C:/xampp/htdocs/culinariaRocha/db/db.php');

$id = $_SESSION['id_utilizador'];
$query = $con->prepare("SELECT * FROM utilizador WHERE id = :id_utilizador");
$query->bindValue(":id_utilizador",$id, PDO::PARAM_STR);
$query->execute();
$utilizador = $query->fetch(PDO::FETCH_ASSOC);
print_r($utilizador);
?>
<div class="w3-main w3-content" style="max-width:1200px;">
    <div class="w3-display-container">
        Meu Perfil
    </div>
    <hr class="bar">
    <div class="w3-bar w3-white">
        <dvi class="w3-bar-item w3-padding-16">
            <ul class="w3-ul w3-center w3-padding-small">
                <li>Id: <?php echo $utilizador['id']; ?></li>
                <li>Nome: <?php echo $utilizador['nome']; ?></li>
            </ul>
        </dvi>
        <dvi class="w3-bar-item w3-padding-16">
            <ul class="w3-ul w3-hoverable">
                <?php
          /*           $query = $con->prepare("SELECT * FROM livro WHERE id = :id_livro");
                    $query->bindValue(":id_livro",$id, PDO::PARAM_STR);
                    $query->execute();
                    $livro = $query->fetch(PDO::FETCH_ASSOC);
                    print_r($livro); */
                ?>
                <li>Numero de livros: </li>
                <li>Numero de receitas enviadas: </li>
                <li>Numero de receitas guardadas: </li>
            </ul>
        </dvi>
    </div>

    <hr class="bar">
    <dvi>
        <ul class="w3-ul w3-hoverable">
        
            <li><a href='frontend\menages\menageUtilizador.php?id=<?php echo $utilizador['id']?>&function=email'>Trocar email</a></li>
            <li><a href='frontend\menages\menageUtilizador.php?id=<?php echo $utilizador['id']?>&function=senha'>Trocar senha</a></li>
            <li><a href='frontend\menages\menageUtilizador.php?id=<?php echo $utilizador['id']?>&function=nome'>Trocar nome</a></li>
            <li><a href='frontend\menages\menageUtilizador.php?id=<?php echo $utilizador['id']?>&function=deletar'>Deletar conta</a></li>
        </ul>
    </dvi>
</div>