<?php 
include "header.php";
include "fonction.php";
//session_start();
if (!isset($_SESSION['id'])){
    echo "<p id='connexion'> Vous devez être connectés <p>";
    
    } else
     { ?>

        <section class="container">
    <div class="row">   
            <div class="col-12 newPost text-center">
            A ton tour de t'exprimer!
            </div>
    </div>
</section>

<form  class="form" role="form" action="newPost.php" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <h3 class="col-12">Choisis ton thèmes!</h3>   
            <?php $reponse= getThemes($bdd);
            while($donnees=$reponse->fetch())
            {?> <div class="col-12">    
                    <input type="checkbox" name="themes[]"  value="<?php  echo $donnees['id'];?>"> 
                    <label><?php echo $donnees['nom'];?></label>   
                </div>         
            <?php
            }
            ?>
        </div>

        <div class="row">
            <h3 class="col-12">Choisis ton titre!</h3>  
            <div class="col-12 form-group">
                <label for="title"> Titre </label>
                <input  class="form-control" type="text"  name="title" value="<?php echo $title; ?>">
                <span class="help-inline"><?php echo $titleError ?></span>
            </div>
            <div class="col-12 form-group">
                <h3 for="img" value="<?php echo $img;?>"> Sélectionne ton image! </h3>
                <input  type="file" name="img" value="<?php echo $img; ?>" >
                <span class="help-inline"><?php echo $imgError ?></span>
            </div>
        </div>

        <div class="form-group">  
                <h3 for="content" value="<?php echo $content; ?>">Contenu de ton article!</h3>
                <textarea class="form-control" rows="5" name="content" value="<?php echo $content; ?>"></textarea> 
                <span class="help-inline"><?php echo $contentError ?></span>          
        </div>
    </div>

    <div class="container forma-actions">
        <button type="submit" class="btn"><span></span> Ajouter </button>
    </div>
<form>
       <?php 
        }
        ?>
<?php include "footer.php";?>
