<?php
include_once ('db\db.php');

$sql = "SELECT * FROM categoria ORDER BY id DESC";
$cmd = $con->prepare($sql);
$cmd->execute();
$result = $cmd->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:50px">
    <hr class="bar">
    <!-- Filtros -->
    <div class="w3-row-padding w3-padding-16 w3-center">
        <?php
        foreach ($result as $key => $value){
        ?>
        <button class="w3-button w3-white w3-round-xxlarge w3-border w3-border-amber w3-round-large"><?php echo $value['nome']?></button>
        <?php
        }
        ?>
        <button class="w3-button w3-white w3-round-xxlarge w3-border w3-border-amber w3-round-large">Mais filtros</button>
    </div>

    <div class="w3-row">
   <!-- First Photo Grid-->
   <?php
    $sql = "SELECT * FROM receita ORDER BY id DESC";
    $cmd = $con->prepare($sql);
    $cmd->execute();
    $result = $cmd->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $key => $value){
    ?>
      <div class="w3-quarter w3-border w3-round-large w3-hover-shadow w3-padding myReceita" style="width:23%">
        <div class="w3-container w3-center">
          <h3><?php echo $value["nome"];  ?></h3>
            <img src="galeria/img3.jpg" class="w3-round" style="width:100%" style="width:23%">
          <p><?php echo $value["modo_preparo"];  ?></p>

          <a href='?pag=5&idReceita=<?php echo $value['id']?>'>Ver</a>
        </div>
      </div>
    <?php
    }
    ?>
    </div>
    <!-- Pagination -->
    <div class="w3-center w3-padding-32">
        <div class="w3-bar">
            <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
            <a href="#" class="w3-bar-item w3-black w3-button">1</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
        </div>
    </div>

    <hr id="about">

</div>
<script>
$(document).ready(function() {
    let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
})
</script>
<style>
    * {box-sizing:border-box}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
</style>