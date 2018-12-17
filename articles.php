<?php include "header.php" ?>

<section class="container">
	
		<div class="row">
			<?php  require 'fonction.php';
				$id =$_GET['id'];
				//var_dump($id);
				$reponse=infoArticles($bdd,$id);
				//var_dump($reponse);
				$donnees=$reponse->fetch();
				$iddd = $donnees['theme_id'];
				$idd=$donnees['user_Id'];
				?>

					<h2 class="row card-header text-capitalize col-12 text-center">
						<div class="col-6">Dans la catégorie: <a href="theme.php?id=<?php echo $iddd;?>">
						<?php  echo $donnees['nom'];?></a></div>
						<a class='btn' href='update.php?id=<?php echo $id;?>'> modifier </a>
						<div class="col-4"><?php  echo $donnees['title'];?></div>
					</h2>

					<div class="row">
						<div class='col-5'>
								<img class="photos" src='<?php  echo $donnees['thumbnail'];?>'>
						</div>

						<div class='col-6'>
							<p> <?php  echo $donnees['content'];?> </p>
							<div class='row'> 
								by : <h5><a href="user.php?id=<?php echo $idd;?>"><?php  echo $donnees['pseudo'];?></a> </h5>
							</div>
						</div>
					</div>					
		</div>
					<?php

					?>
					<div class="row">
						<a href="delete.php?id=<?php echo $id;?>">
							<button type="submit" class="btn" >
							Supprimer l'Article
							 </button>
						</a>
    				</div>
		
</section>

<?php include "footer.php" ?>
