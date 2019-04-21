<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo ($titrePage) ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body class="bg-light" >
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Enchères Inversées</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=produits">Produits <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=categorie">Catégories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=inscriptionUser">S'inscrire</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=search">Rechercher</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0"  method="POST" action="index.php?p=connexion">
            <div class="form-group">
                <input class="form-control mr-sm-2" name="log" type="text" placeholder="login" aria-label="Login">
                <input class="form-control mr-sm-2" name="m2p" type="password" placeholder="Mot de passe" aria-label="Mot de passe">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Connexion</button>
            </div>

        </form>

    </div>
</nav>
<!-- contenu -->
<div class="container ">
    <?=$content ?>
</div>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>