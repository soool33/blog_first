
<?php  require 'connexion.php'; 
session_start();

function newContact($bdd) 
{
	$query=$bdd->prepare('INSERT INTO users(pseudo,mail,pass) VALUES (:pseudo,:mail,:pass)');
	$query->execute([
		'pseudo'=>$_POST['pseudo'],
		'mail'=>$_POST['mail'],
		'pass'=>$_POST['pass']
	]);
    header("location:index.php");    
}


function lastArticles($bdd) //pagination tuto = https://www.youtube.com/watch?v=dYMi89K1Bsg
{
    $nbArt=$bdd->query("SELECT COUNT(id) as nbArt FROM posts");
    $nbArt=$nbArt->fetch();
    $nbArt = intval($nbArt["nbArt"]);
    $parPage = 4;          
    $nbPage = ceil($nbArt/$parPage);

    if (isset($_GET['p']) && $_GET['p'] && $_GET['p']<=$nbPage)
    {
        $pageCour =  $_GET['p'];
    }
    else
    {
        $pageCour = 1;
    }

   
    $reponse=$bdd->query('SELECT * FROM posts ORDER BY published DESC LIMIT '.(($pageCour-1)*$parPage).','.$parPage.'');

    for($i=1;$i<=$nbPage;$i++)
    {
        if($i==$pageCour)
        {
            echo "$i /";
        }
        else
        {
            echo "<a href= \"index.php?p=$i\" > $i </a> / ";
        }        
    };   
    return $reponse;
}

function getThemes($bdd)
{
    $reponse=$bdd->query('SELECT * FROM `themes` ');
    return $reponse;
}

$title = $img = $content = ""; 
$titleError = $imgError = $contentError = "";
if (!empty($_POST))
{
    $title             =checkInput($_POST["title"]);
    $img                =checkInput($_FILES["img"]["name"]);
    $imgPath            ='img/'. basename($img);
    $imgExtension       = pathinfo($imgPath, PATHINFO_EXTENSION);
    $isSuccess           = true;
    $isUploadSuccess    = false;
    $content            =checkInput($_POST["content"]);
    $id                 = $_SESSION['id']; 
    $themeId            = $_POST["themes"];

    if(empty($title))
    {
        $titleError   = "Ajoutes nous un joli titre!"; 
        $isSuccess           = false;
    }
    if(empty($content))
    {
        $contentError   = "C'est mieux quand c'est rempli!";
        $isSuccess           = false;
    }
    if(empty($img))
    {
        $imgError   = "Avec une image ça serait mieux!";
        $isSucess           = false;
    }
        else
        {
            $isUploadSuccess    = true;
            if($imgExtension != "jpg" && $imgExtension != "png" && $imgExtension != "jpeg" && $imgExtension != "gif" )
            {
                $imgError = "Les fichiers autorisés sont de type: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess    = false;
            }
            /*if(file_exists($imgPath))
            {
                $imgError = "Le fichier existe déjà";
                $isUploadSuccess    = false;
            }
            if($_FILES["img"]["size"] > 500000)
            {
                $imgError = "Le fichier ne doit dépasser les 500KB";
                $isUploadSuccess    = false;
            }*/
            if($isUploadSuccess)
            {
                if(!move_uploaded_file($_FILES["img"]["tmp_name"],$imgPath))
                {
                    $imgError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess    = false;
                }
            }
        }

        if($isSuccess && $isUploadSuccess )
        {
               newPost($bdd,$title,$imgPath,$content,$id);
               $postId = getLastImg($bdd,$imgPath);
               $tab_themes = $themeId;
               foreach ($tab_themes as $theme)
               {
                   newThemes($bdd,$postId,$theme);
                }               
            header("location: index.php");            
        }
}

function newPost($bdd,$title,$imgPath,$content,$id)
{
    
    $statement = $bdd->prepare("INSERT INTO `posts`(`thumbnail`, `title`, `content`,`user_Id`) 
    VALUES (:img,:title,:content,:userId)");
   $requete = $statement->execute(array(
        'img'=>$imgPath,
        'title'=>$title,
        'content'=>$content,
        'userId'=>$id             
        ));
}

function getLastImg($bdd,$imgPath)
{
    $newPost = $bdd->query('SELECT * FROM posts WHERE thumbnail="'.$imgPath.'"');
    $rep = $newPost->fetch(); 
    //var_dump($newPost);
    return $rep['id'];
}

function newThemes($bdd,$postId,$theme)
{
    //var_dump($theme);
    //var_dump($postId);
    $statement = $bdd->prepare("INSERT INTO `post_theme`(`post_id`, `theme_id`) VALUES(:postId,:themeId)");
    $requete = $statement->execute(array(
        'postId'=>"$postId",
        'themeId'=>"$theme",             
        ));
    //var_dump($_POST); 
}

function checkInput($var)
{
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

function infoArticles($bdd,$id) 
{
    $reponse=$bdd->query('SELECT * 
    FROM posts 
    INNER JOIN post_theme ON posts.id=post_theme.post_id 
    INNER JOIN themes ON theme_id=themes.id
    INNER JOIN users ON users.id= posts.user_id 
    WHERE posts.id='.$id);
    return $reponse;
}

function themes($bdd,$id)
{
    $reponse=$bdd->query('SELECT posts.thumbnail,posts.title,posts.content,posts.published,themes.nom AS themes,users.pseudo AS auteur
    FROM posts 
    INNER JOIN post_theme ON posts.id=post_theme.post_id 
    INNER JOIN themes ON theme_id=themes.id
    INNER JOIN users ON users.id= posts.user_id
    WHERE themes.id='.$id.'');
    //var_dump($id);
    return $reponse;
    //var_dump($reponse);
}

function infoUser($bdd,$id) {
    $reponse=$bdd->query('SELECT * FROM `posts` INNER JOIN users ON posts.`user_Id` =users.id WHERE users.id=' .$id.'');
    return $reponse;
}


function updateContent($bdd,$id,$title,$content) {
    $reponse=$bdd->prepare('UPDATE posts SET title=:title,content=:content WHERE id =' .$id.'');
    $requete=$reponse->execute(array(
        'title'=>$title,
        'content'=>$content,
    ));
   
    header("location: articles.php?id=".$id);
    var_dump($id);
}
