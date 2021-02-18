<?php 
	session_start();
        if($_POST){
	if(isset($_POST["produit"]) && !empty($_POST["produit"])
	  && isset($_POST["prix"]) && !empty($_POST["prix"])
	  && isset($_POST["quantite"]) && !empty($_POST["quantite"])){
	require_once("connect.php");

        $produit = strip_tags($_POST["produit"]);
        $prix = strip_tags($_POST["prix"]);
        $quantite = strip_tags($_POST["quantite"]);

        $sql = "INSERT INTO liste (produit, prix, quantite) VALUES (:produit, :prix, :quantite)";
        $query = $db->prepare($sql);
        $query->bindValue(":produit", $produit);
        $query->bindValue(":prix", $prix);
        $query->bindValue(":quantite", $quantite);
        $query->execute();

      //  $_SESSION['message'] = "Produit ajouté avec succés";

	require_once('close.php');

       header('Location: index.php');
       } else{
              $_SESSION['erreur'] = "Le formulaire est incomplet!";
      }
   }
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <title>Ajouter un produit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<body>
<main class="container">
 <?php require_once("header.php"); ?>
<div class="row">
   <section class="col-12">

         <?php
             if(!empty($_SESSION['erreur'])){
             echo '<div class="alert alert-danger" role="alert">'
                    .$_SESSION['erreur'].'</div>';
               $_SESSION['erreur'] = "";
        }

        ?>

		
     <h1>Ajouter un produit</h1>
       <form method="POST">
          <div class="form-group">
              <label for="produit">Produit:</label>
              <input type="text" id="produit" name="produit" class="form-control">
          </div>
       
          <div class="form-group">
              <label for="prix">Prix:</label>
              <input type="text" id="prix" name="prix" class="form-control">
          </div>
         <div class="form-group">
              <label for="quantite">Quantité:</label>
              <input type="number" id="quantite" name="quantite" class="form-control">
          </div>
        <a href="index.php">Retour</a>
        <button class="btn btn-primary">AJOUTER</button>
      </form>
   </section>
</div>
<?php require_once("footer.php"); ?>
</main>
</body>
</head>
</html>
