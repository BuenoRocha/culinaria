<?php
include_once ('C:/xampp/htdocs/culinariaRocha/db/db.php');

if(!empty($_GET["idReceita"])){
  $id = $_GET["idReceita"];
  }else {$id = "";}

$query = $con->prepare("SELECT * FROM receita WHERE id = :id_receita");
$query->bindValue(":id_receita",$id, PDO::PARAM_STR);
$query->execute();
$receita = $query->fetch(PDO::FETCH_ASSOC);
?>

<div>
  <div class="w3-bar-item w3-padding-16">
    <h1><?php echo $receita['nome']; ?></h1>
  </div>

  <hr class="bar">
  <h3>Introdução</h3>
  <div>
    <h4><?php echo $receita['introducao']; ?></h4>
  </div>

  <hr class="bar">
  <div>Galeria</div>
  <!-- Slide -->
  <div class="w3-content w3-display-container" style="width:800px;margin:auto">
  </div>
  <hr class="bar">
  <div>
    <h4>
      <p><b>Dificuldade: </b><?php echo $receita['dificuldade']; ?></p>
      <p><b>Porção: </b> <?php echo $receita['porcao']; ?> porcões</p>
      <p><b>Tempo: </b> <?php echo $receita['tempo']; ?> </p>
      <p><b>Data :</b> 20/05/2020</p>
    </h4>
  </div>

  <hr class="bar">
  <h3>Ingredientes</h3>
  <p><?php echo $receita['ingredientes']; ?></p>
  <!-- <div>
    <h4>
      <ul>
        <li>Coffee</li>
        <li>Tea</li>
        <li>Milk</li>
      </ul>
    </h4> -->
  </div>

  <hr class="bar">
  <h3>Modo de preparo</h3>
  <p><p><?php echo $receita['modo_preparo']; ?></p></p>

  <hr class="bar">
  <div>Comentários</div>

  <hr class="bar">
  <div>
    <h4>Classificação</h4>
  </div>
</div>