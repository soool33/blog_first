<?php 
session_start();
require_once 'log_in.php';

if (isset($_POST['login'])) {
	//var_dump("coucou1");
	//var_dump($_POST);
	if (empty($_POST['mail']) || empty($_POST['pass'])) {
		
		header("location:log_in.php?invalide=fill in the blanks");
	} else {
		$mail=$_POST['mail'];
		$pass=$_POST['pass'];
		
		$query='SELECT * from users WHERE mail="'.$mail.'" AND pass="'.$pass.'"';
		$result=$bdd->query($query);
		$donnees=$result->fetch();

		if ($donnees) {		
			$_SESSION['mail']=$_POST['mail'];
			$_SESSION['id']=$donnees['id'];
			var_dump($donnees['id']);
			header("location:newPost.php");
		} else {
			var_dump("cou4");
			header("location:log_in.php?invalid=entrez vos id");
		}
	}
}