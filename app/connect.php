<?php

try{
    $db  = new PDO('mysql:host=mysql; dbname=data_bd', 'toto','toto_md');
    $db->exec('SET NAMES "UTF8"');
  } catch(PDOException $e){
	echo 'Erreur : ' .$e->getMessage();
	die();
    }
