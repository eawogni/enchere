<p><h1>Vos informations personnelles</h1></p>
<?php
    if (isset($msgUpdate)): ?>
        <p>
        <div class="alert alert-success " role="alert">
            <?php echo $msgUpdate ?>
        </div>
        </p>

<?php  endif;?>

<form action="index.php?p=compte" method="POST">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" id="nomUser" name="nomUser" value="<?php echo $infoUser->nom; ?>">


    </div>
    <div class="form-group">
        <label for="prenomUser">Prénom</label>
        <input type="text" class="form-control" name="prenomUser" id="prenomUser"
               value="<?php echo $infoUser->prenom; ?>">
    </div>
    <div class="form-group">
        <label for="emailUser">Email</label>
        <input type="email" class="form-control" name="emailUser" id="emailUser" value="<?php echo $infoUser->mail; ?>">
    </div>
    <?php
if (isset($msgEmail)) {
    echo "<div style='color:tomato'> {$msgEmail} </div>";
    $content =
        "<script> 
                   var mail =     document.getElementById('emailUser');
                   mail.style.border ='1px solid red';  
        </script>";

    echo $content;
    }

    ?>
    <?php
    if (isset($msgNomPren)) {
        echo "<div class='text-danger'> {$msgNomPren} </div>";

    }
    ?>

    <button type="submit" class="btn btn-primary">Modifier mes informations</button>

</form>
<h1>Modifier votre mot de passe</h1>
<form action="index.php?p=compte" method="POST">
    <div class="form-group">
        <label for="m2pUserActuel">Ancien mot de passe</label>
        <input type="password" class="form-control" name="m2pUserActuel" id="m2pUserActuel">
    </div>
    <div class="form-group">
        <label for="nvoM2pUser">Nouveau mot de passe</label>
        <input type="password" class="form-control" name="nvoM2pUser" id="nvoM2pUser">
    </div>
    <div class="form-group">
        <label for="nvoM2pUser2">Retapez votre nouveau mot de passe</label>
        <input type="password" class="form-control" name="nvoM2pUser2" id="nvoM2pUser2">
    </div>
    <?php if(isset($msgErrM2p)) :?>
    <div class="text-danger">
        <?php echo $msgErrM2p; ?>
    </div>

    <?php endif;?>

    <button type="submit" class="btn btn-primary">Modifier</button>

</form>

