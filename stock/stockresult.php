<?php
    //Connection à une base de données via PDO
    define("PDO_HOST", "localhost"); 
    define("PDO_DBBASE", "id9227854_stock");
    define("PDO_USER", "id9227854_root");
    define("PDO_PW", "userroot");
    try
    {
    	$bdd = new PDO("mysql:host=".PDO_HOST.";dbname=".PDO_DBBASE.";charset=utf8", PDO_USER, PDO_PW);
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    
    // On mets à jour le stock
    $nb=$_GET['nb'];
    $bdd->exec("UPDATE produit SET unitesstock = '$nb' WHERE numfournisseur = 20");
    // Rediriger vers stockmodif.html
    header('Location: stockmodif.html');
    ?>