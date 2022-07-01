<?php
session_start();

if(!empty($_GET["pag"])){
$pag = $_GET["pag"];
}else {$pag = "";}
?>
<html>
<head>
    <title>Culinária Rocha</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>

    <!--Top menu-->
    <header>
        <nav>
            <a class="logo" href="?pag=0">Culinária Rocha</a>
            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-list" id="menu">
                <li><a href="?id=1">Biblioteca </a></li>
                <?php if(!isset($_SESSION['id_utilizador'])){ ?>
                    <li><a href="?pag=2">Login</a></li>
                <?php }else{ ?>
                    <li><a href="?pag=4">Perfil</a></li>
                <?php } ?>
                
            </ul>
        </nav>
    </header>
        <div class="w3-main w3-content w3-padding" style="max-width:1000px;margin-top:20px">
            <div id="container">
                <?php
                switch($pag){
                    case 0:
                        include_once("frontend/pages/home.php");
                        break;
                    case 1:
                        include_once("frontend/pages/biblioteca.php");
                    break;
                    case 2:
                        include_once("C:/xampp/htdocs/culinariaRocha/login/logar.php");
                    break;
                    case 3:
                        include_once("login\cadastrar.php");
                    break;
                    case 4:
                        include_once("C:/xampp/htdocs/culinariaRocha/frontend/pages/perfil.php");
                    break;
                    case 5:
                        include_once("frontend/pages/receita.php");
                    break;
                    default:
                    include_once("frontend/pages/home.php");
                }
                ?>
            </div>
        </div>
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;">
        <footer class="w3-row-padding w3-padding-32">
            <div class="w3-third">
                <h3>Sobre Nós</h3>
                <p>Este site foi criado no intuito de ter pessoas compartilhando e guardando receitas em diversos livros e facilitar suas pesquisas e seleções com uma variedade abrangente!</p>
            </div>

            <div class="w3-third">
                <h3>Redes Sociais</h3>
                <ul class="w3-ul w3-hoverable">
                    <li class="w3-padding">
                        <span class="w3-large">Facebook</span><br>
                    </li>
                    <li class="w3-padding">
                        <span class="w3-large">Instagram</span><br>
                    </li>
                    <li class="w3-padding">
                        <span class="w3-large">WhatsApp</span><br>
                    </li>
                </ul>
            </div>

            <div class="w3-third w3-serif">
                <h3>Categorias</h3>
                <p>
                    <a class="w3-tag w3-black w3-margin-bottom">Travel</a> <span
                        class="w3-tag w3-dark-grey w3-small w3-margin-bottom">New York</span> <span
                        class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Dinner</span>
                    <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Salmon</span> <span
                        class="w3-tag w3-dark-grey w3-small w3-margin-bottom">France</span> <span
                        class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Drinks</span>
                    <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Ideas</span> <span
                        class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Flavors</span> <span
                        class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Cuisine</span>
                </p>
            </div>
        </footer>
    </div>
    
    <script>
            // Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }
    // Script Slideshow
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndex - 1].style.display = "block";
    }

    </script>
    <script src="frontend/js/mobile-navbar.js"></script>
</body>

</html>
