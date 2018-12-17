<?php 
include "header.php";
require "fonction.php";

    $id= $_GET['id'];
    //var_dump($_GET['id']);
    $reponse = $bdd->prepare('DELETE FROM posts WHERE id='.$id.'');
    $requete = $reponse->execute(array($id));
    //var_dump($id);
    
    header("location:index.php");
?>

<h1 class="text-center col-12"><strong>Supprimer l'article</strong></h1>
<form class="form container" role="form" action="delete.php" method="post" >

    <p class="alert alert-warning">Etes vous sur de vouloir supprimer?</p>
    
    <div class="row form-actions">
        <button class="col-3" type="submit" class="btn">
        OUI
        </button>

        <button class="col-3" class="btn">
        NON
        </button>
    </div>
</form>

<?php include "footer.php";?>