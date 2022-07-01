<?php
session_start();

if (!isset($_SESSION['id_utilizador']) && !isset($_SESSION['nivel'])) {

    header("location: ../");
} else {
    if ($_SESSION['nivel'] != 'M' && $_SESSION['nivel'] != 'E') {
        header("location: ../");
    }
    
}

if (!empty($_GET["pag"])) {
    $pag = $_GET["pag"];
} else { $pag = "";}
?>
<html>

<head>
    <title>Livraria Rocha</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</head>

<body>
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="leftMenu">
        <a href="?pag=0" class="nav-link w3-bar-item w3-button">Home</a>
        <a href="?pag=1" class="nav-link w3-bar-item w3-button">Categorias</a>
        <a href="?pag=2" class="nav-link w3-bar-item w3-button">Receitas</a>
        <a href="?pag=3" class="nav-link w3-bar-item w3-button">Livros</a>
        <a href="?pag=4" class="nav-link w3-bar-item w3-button">Utilizador</a>
        <a href="?pag=5" class="nav-link w3-bar-item w3-button">Comentários</a>
        <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large">Fechar &times;</button>
    </div>

    <div class="w3-amber">
        <button class="w3-button w3-amber w3-xlarge w3-left" onclick="openLeftMenu()">&#9776;</button>
        <div class="w3-container">
            <h1>My Page</h1>
        </div>
    </div>
    <main>
        <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:50px">
            <div id="container">
            <?php
switch ($pag) {
    case 0:
        include_once "pages/home.php";
        break;
    case 1:
        include_once "pages/categorias.php";
        break;
    case 2:
        include_once "pages/receitas.php";
        break;
    case 3:
        include_once "pages/livros.php";
        break;
    case 4:
        include_once "pages/utilizador.php";
        break;
    case 5:
        include_once "pages/comentarios.php";
        break;
    case 6:
        include_once "menages\menageCategoria.php";
        break;
    case 7:
        include_once "menages\menageReceita.php";
        break;
    case 8:
        include_once "menages\menageLivro.php";
        break;
    case 9:
        include_once "menages\menageUtilizador.php";
        break;
    default:
        include_once "pages/home.php";
}
?>
            </div>
        </div>
    </main>

    <script>

    function openLeftMenu() {
        document.getElementById("leftMenu").style.display = "block";
    }

    function closeLeftMenu() {
        document.getElementById("leftMenu").style.display = "none";
    }
    </script>

</body>

</html>