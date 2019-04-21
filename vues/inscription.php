<h1 class="mx-auto" style="width: 200px;"> Inscription</h1>
<hr>
<div class="mx-auto" style="width: 60%;">

    <?php
    if (isset ($msg)) {
        echo "<div style='color: red'> $msg </div>";
    } ?>

    <form method="POST" id="formInscription" action="index.php?p=inscrire">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Entrez un login">
            <?php
            if (isset($msgLogin)) {
                echo "<div style='color:tomato'> {$msgLogin} </div>";
                $content =
                    "<script> 
                   var login =     document.getElementById('login');
                   login.style.border ='1px solid red';
                   login.setAttribute('value','{$_POST['login']}');
                </script>";

                echo $content;
            }
            if (isset($_POST['login'])) {
                $content =
                    "<script>
                       var login = document.getElementById('login');
                       login.setAttribute('value','{$_POST['login']}');
                  </script>";
                echo $content;

            }
            ?>
        </div>

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom">
            <?php
            if (isset($_POST['nom'])) {
                $content =
                    "<script>
                       var nom = document.getElementById('nom');
                       nom.setAttribute('value','{$_POST['nom']}');
                  </script>";
                echo $content;

            }

            ?>
        </div>
        <div class="form-group">
            <label for="pren">Prénom</label>
            <input type="text" class="form-control" id="pren" name="pren" placeholder="Entrez votre Prénom">
            <?php
            if (isset($_POST['pren'])) {
                $content =
                    "<script>
                       var prenom = document.getElementById('pren');
                       prenom.setAttribute('value','{$_POST['pren']}');
                  </script>";
                echo $content;
            }

            ?>
        </div>
        <div class="form-group">
            <label for="dateNaiss">Date de naissance</label>
            <input type="date" class="form-control" name="dateNaiss" id="dateNaiss">
            <?php
            if (isset($_POST['dateNaiss'])) {
                $content =
                    "<script>
                       var dateNaiss = document.getElementById('dateNaiss');
                       dateNaiss.setAttribute('value','{$_POST['dateNaiss']}');
                  </script>";
                echo $content;
            }
            if (isset($_POST['dateNaiss'])) {
                $content =
                    "<script>
                       var dateNaiss = document.getElementById('dateNaiss');
                       dateNaiss.setAttribute('value','{$_POST['dateNaiss']}');
                  </script>";
                echo $content;

            }
            ?>
        </div>

        <div class="form-group">
            <label for="mail">Email</label>
            <input type="email" class="form-control" id="mail" aria-describedby="emailHelp" name="mail"
                   placeholder="Entrez un email valide">
            <?php
            if (isset($msgEmail)) {
                echo "<div style='color:tomato'> {$msgEmail} </div>";
                $content = "<script> 
                    var email =document.getElementById('mail');
                    email.style.border ='1px solid red';
                    email.setAttribute('value', '{$_POST['mail']}');
                </script>";

                echo $content;
            }
            if (isset($_POST['mail'])) {
                $content =
                    "<script>
                       var mail = document.getElementById('mail');
                       mail.setAttribute('value','{$_POST['mail']}');
                  </script>";
                echo $content;

            }

            ?>
        </div>
        <div class="form-group">
            <label for="passwd">Mot de passe</label>
            <input type="password" class="form-control" id="passwd" name="passwd"
                   placeholder="Choisissez un mot de passe">
            <?php
            if (isset($msgPasswd)) {
                echo "<div style='color:tomato'> {$msgPasswd} </div>";
                $content = "<script> 
                    var passwd =document.getElementById('passwd');
                    passwd.style.border ='1px solid red';
                </script>";

                echo $content;
            }
            if (isset($_POST['passwd'])) {
                $content =
                    "<script>
                       var passwd = document.getElementById('passwd');
                       passwd.setAttribute('value','{$_POST['passwd']}');
                  </script>";
                echo $content;

            }
            ?>
        </div>
        <div class="form-group">
            <label for="passwd2">Retapez votre mot de passe</label>
            <input type="password" class="form-control" id="passwd2" name="passwd2"
                   placeholder="Retapez le même mot de passe">
            <?php
            if (isset($_POST['passwd2'])) {
                $content =
                    "<script>
                       var passwd2 = document.getElementById('passwd2');
                       passwd2.setAttribute('value','{$_POST['passwd2']}');
                  </script>";
                echo $content;

            }
            ?>
        </div>

        <input type="submit" value="Envoyer" class="btn btn-primary">

    </form>
</div>
<!--<script src="js/inscriptionScript.js"></script> -->