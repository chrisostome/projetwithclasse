<?php
      session_start();

	if(isset($_GET['id']) && !empty($_GET['id'])){
	     require_once('connect.php');
             $id = strip_tags($_GET['id']);
             $sql = 'DELETE FROM liste WHERE id= :id;';
             $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $produit = $query->fetch();

              $_SESSION['message'] = "Produit supprimé";
             header('Location: index.php');

   
	}else{
           $_SESSION['Erreur'] = " URL invalide ";
           header('Locatio: index.php');
	}
?>
