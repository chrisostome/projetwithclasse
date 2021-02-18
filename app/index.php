<?php 
	session_start();
	require_once('connect.php');
	$sql = 'SELECT * FROM liste';
	$query = $db->prepare($sql);
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	require_once('close.php');
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <title>Liste des produits</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<body>
<main class="container">

 <?php require_once("header.php");?>

<div class="row">
   <section class="col-12">
	<?php
             if(!empty($_SESSION['erreur'])){
             echo '<div class="alert alert-danger" role="alert">' 
		    .$_SESSION['erreur'].'</div>';
               $_SESSION['erreur'] = "";
	}

	?>

     



	<h1>LISTE DES PRODUITS</h1>
   <table class="table">
      <thead>
         <th>ID</th>
         <th>Produit</th>
         <th>Prix (En Ariary)</th>
         <th>Quantité</th>
         <th>Actions</th>
	
         <thead>
      <tbody>
   <?php
	foreach($result as $produit){
   ?>
        <tr>
            <td> <?= $produit['id']  ?>  </td>
            <td> <?= $produit['produit']  ?>  </td>
            <td> <?= $produit['prix']  ?>  </td>
            <td> <?= $produit['quantite']  ?>  </td>
            <td> <a href="details.php?id=<?= $produit['id']  ?>">Voir</a> 
                 <a href="edit.php?id=<?= $produit['id']  ?>">Modifier</a> 
                 <a href="delete.php?id=<?= $produit['id'] ?>">Supprimer</a>
            </td>
        </tr>
   <?php
     }
   ?>
      </tbody>
   </table>
	<a href="add.php" class="btn btn-primary">Ajouter un produit</a>
     </section>
</div>

 <?php require_once("footer.php"); ?>

</main>
</body>
</head>
</html>
