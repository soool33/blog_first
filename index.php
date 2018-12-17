
<?php 
session_start();
 include "header.php" ?>


<?php include "fonction.php";?>

<section>
	<div class="container">		
		<?php $reponse= lastArticles($bdd);
		while ($donnees=$reponse->fetch())
		{ ?>
		<div class="row">
			<div class="col-12">
				<h2 class="card-header text-capitalize text-center">
					<?php  echo $donnees['title'];?>
				</h2>
			</div>
		</div>
				<div><img class="photos" src=" <?php  echo $donnees['thumbnail'];?> "></div>
				<div class="card-header text-capitalize"><?php  echo $donnees['content'];?></div>
							
				<div>
					<a class="btn btn-primary" href="articles.php?id=<?php echo $donnees['id']; ?>">Details</a>
				</div>
		<?php      
		}
		?> 
	</div>
</section>

<section>
	<div class="container">
		<div class="row">
		<a href="newPost.php" class="btn">AJOUTE TON POST</a>
		</div>
	</div>
</section>


<?php include "footer.php" ?>




