<?php
      session_start();
	
	if(isset($_GET['id']) && !empty($_GET['id'])){
	     require_once('connect.php');
             $id = strip_tags($_GET['id']);
             $sql = 'SELECT * FROM liste WHERE id= :id;';
             $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $produit = $query->fetch();
	if(!$produit){
            $_SESSION['erreur'] = "Ce ID n'existe pas!";
             header('Location: index.php');
	}    
	}else{
           $_SESSION['Erreur'] = " URL invalide ";
           header('Location: index.php');
	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details</title>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



<body>
	<main class="container">
	<?php require_once("header.php");?>
	 <div class="row">
	     <section class="col-12">
                <h1>Détails du produit <?= $produit['produit'] ?></h1>
                
                <p>ID: <?= $produit['id'] ?></p>
               
                <p>Produit: <?= $produit['produit'] ?></p>
                <p>Prix: <?= $produit['prix'] ?></p>
                <p>Quantité: <?= $produit['quantite'] ?></p>
                <p><a href="index.php">Retour</a> 
	         <a href="edit.php?id= <?= $produit['id'] ?>">Modifier</a></p>
             </section>
         </div>
	<?php require_once("footer.php"); ?>
	</main>
</body>
</head>
</html>
