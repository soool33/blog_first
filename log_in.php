<?php 
//session_start();
require 'connexion.php';
include 'headerSamy.php';
//$_SESSION['mail']=$_POST['mail'];
//$_SESSION['pass']=$_POST['pass'];
?>
 <?php 
/*require 'connexion.php';

if ($_POST) {

    extract($_POST);
        {
            $sql="SELECT * FROM users";
        }
    $resultat=mysqli_query($bdd,$sql);
    var_dump($resultat);
    if($resultat){
        if(mysqli_num_rows($resultat)==0){
        echo 'Utilisateur ou mot de passe incorrecte !!';
        }
        else {
            $row=mysqli_fetch_assoc($resultat);
            $_SESSION['mail']=$row['mail'];
            $_SESSION['pass']=$row['pass'];
            header('location:index.php');
        }
    }
    mysqli_free_result($resultat);
    mysqli_close($bdd);
}-------------------------------------------------------*/
?> 
<div class="container">
    <form id="contact" action="session.php" method="post"> <!-- enctype="multipart/form-data" -->
        <h3>Connexion</h3>
        <h4>Entrez votre email et mot de passe</h4>
        
        <fieldset>
            <input name="mail" placeholder="email" type="email" tabindex="2" >
        </fieldset>

        <fieldset>
            <input type="password" id="myInput" name="pass" placeholder="mot de passe" type="text" tabindex="3"><br>
            <input type="checkbox" onclick="myFunction()"> <i class="fas fa-eye fa-2x"></i>
        </fieldset>

        <fieldset>
            <button type="submit" id="contact-submit" name="login" >Valider</button>
        </fieldset>
    </form> 
</div>
<script>
function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      } 
</script>

<script src="library/bootstrap/js/bootstrap.bundle.js"></script>
	<script src="library/jQuery.js"></script>
	<script src="js/script.js"></script>
    </body>
</html>