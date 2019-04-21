
<div class="mx-auto bg-dark" style="width: 35%; margin-top:11% ">
<div class="mx-auto"  style="width: 80%;">
    <h1 class="mx-auto text-white" style="width: 200px;"> Connexion</h1>



<form class="my-2 my-lg-0 "  method="POST" action="index.php?p=connexion">
    <div class="form-group">
        <input class="form-control mr-sm-2" name="log" type="text" placeholder="login" aria-label="Login">
        <br>
        <input class="form-control mr-sm-2" name="m2p" type="password" placeholder="Mot de passe" aria-label="Mot de passe">
        <br>
        <div style="color:red"><?php  if (isset($msg)) {echo $msg ; unset($msg);} ?></div>
        <br>
        <p><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Connexion</button></p>
        <br>
    </div>

</form>


</div>

</div>
