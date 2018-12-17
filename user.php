<?php
session_start();
include "header.php";
	 require 'fonction.php';
	    $idd =$_GET['id'];
	
		$reponse=infoUser($bdd,$idd);
		//var_dump($reponse);
		while ($donnees=$reponse->fetch()) {
			echo "<h3> Posté par : " .$donnees['pseudo']." </h3><span>".$donnees['title']."</span>";
			echo "<div class='card'>";
			echo "<p>" .$donnees['content']. "</p>";
			echo "</div>";
		}