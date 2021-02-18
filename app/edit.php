<?php 
	session_start();
           
        if($_POST){
        if(isset($_POST["id"]) && !empty($_POST["id"])
          && isset($_POST["produit"]) && !empty($_POST["produit"])
          && isset($_POST["prix"]) && !empty($_POST["prix"])
          && isset($_POST["quantite"]) && !empty($_POST["quantite"])){
        require_once("connect.php");

        $id = strip_tags($_POST["id"]);
        $produit = strip_tags($_POST["produit"]);
        $prix = strip_tags($_POST["prix"]);
        $quantite = strip_tags($_POST["quantite"]);

        $sql = "UPDATE liste SET produit=:produit, prix=:prix, quantite=:quantite WHERE id=:id";
        $query = $db->prepare($sql);
	$query->bindValue(":id", $id);
        $query->bindValue(":produit", $produit);
        $query->bindValue(":prix", $prix);
        $query->bindValue(":quantite", $quantite);
        $query->execute();

       // $_SESSION['message'] = "Produit modifié";

        require_once('close.php');

       header('Location: index.php');
       } else{
              $_SESSION['erreur'] = "Le formulaire est incomplet!";
      }
   }




	  if(isset($_GET['id']) && !empty($_GET['id'])){
             require_once('connect.php');
             $id = strip_tags($_GET['id']);
             $sql = 'SELECT * FROM liste WHERE id= :id;';
             $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $produit = $query->fetch();
        if(!$produit){
            $_SESSION['erreur'] = "Ce ID n'exite pas!";
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
   <title>Modification d'un produit</title>
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

		
     <h1>Modification d'un produit</h1>
       <form method="POST">
          <div class="form-group">
              <label for="produit">Produit:</label>
              <input type="text" id="produit" name="produit"
		 class="form-control" value="<?= $produit['produit']?>">
          </div>
       
          <div class="form-group">
              <label for="prix">Prix:</label>
              <input type="text" id="prix" name="prix" 
	       class="form-control" value="<?= $produit['prix']?>">
          </div>
         <div class="form-group">
              <label for="quantite">Quantité:</label>
              <input type="number" id="quantite" name="quantite" 
	       class="form-control" value="<?= $produit['quantite']?>">
          </div>
        <input type="hidden" name="id" value="<?= $produit['id']?>">
        <a href="index.php">Retour</a>
        <button class="btn btn-primary">VALIDER</button>
      </form>
   </section>
</div>
<?php require_once("footer.php"); ?>
</main>
</body>
</head>
</html>
