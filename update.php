<?php 
session_start();
include "headerSamy.php";
require 'fonction.php'; 

if (isset($_POST['upd'])) {
	$id=$_POST['id'];
	$title=$_POST['title'];
	$content=$_POST['content'];

	//var_dump($id, $title, $content);
	updateContent($bdd,$id,$title,$content);
} else {
	$id = $_GET['id'];
	$reponse=infoArticles($bdd,$id);
	while ($donnees=$reponse->fetch()) {
		//var_dump($donnees);
	?>

	<div class="container">  
    <form id="contact" action="update.php" method="post" >  <!-- enctype="multipart/form-data" -->
        <h3>update post</h3>
        <fieldset>
            <input name="title" type="text" value= '<?php echo $donnees['title']; ?>' >
        </fieldset>
        
        <fieldset>
            <textarea name="content" type="text" tabindex="2"><?php echo $donnees['content']; ?></textarea>
        </fieldset>


		<fieldset>
            <input name="id" type="hidden" tabindex="3" value=<?php echo $_GET['id']; ?> > 
        </fieldset>
        
        <fieldset>
            <button type="submit" id="contact-submit" name="upd" >Valider</button>
        </fieldset>
    </form> 
	</div> <?php
	} 
}
?>
