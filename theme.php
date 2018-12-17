<?php include "header.php" ?>

<section class="container">	
		
			<?php  require 'fonction.php';
				$iddd = $_GET['id'];
				$reponse = themes($bdd,$iddd);
                //var_dump($reponse);
				while ($donnees=$reponse->fetch())
				{?>
                <div class="row">
                    <h2 class="col-12 card-header text-center text-capitalize"><?php  echo $donnees['title'];?></h2>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <img class="photos" src='<?php  echo $donnees['thumbnail'];?>'>  
                    </div>                  
                    <div class="col-12 col-md-6">
                        <?php  echo $donnees['content'];?>
                    </div>
                </div>
                <?php
                }
                ?>
</section>

<?php include "footer.php" ?>