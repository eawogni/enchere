<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo ($titrePage) ?></title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Enchères Inversées</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=search">Rechercher</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=produits">Produits <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=categorie">Catégories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=misesUser">Mes Mises</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=compte">Mon Compte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=recharger">Recharger</a>
            </li>

        </ul>
        <?php
        if (isset($_SESSION['user'])&& isset($_SESSION['solde'])):?>
            <div class="text-light"><?php echo ($_SESSION['solde']); ?></div>
            <img src='images/imgEuro.png'>
            <div class="text-light"><?php echo htmlentities($_SESSION['user']) ; ?></div>

        <?php endif;?>
             <a href="index.php?p=deconnexion"><button class="btn btn-outline-danger my-2 my-sm-0" >Déconnexion</button></a>

    </div>
</nav>
<!-- contenu -->
<div class="container">
    <?=$content ?>
</div>

<!-- Modal -->
<div class="modal fade" id="encherirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>