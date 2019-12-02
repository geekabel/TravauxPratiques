<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <title>Gestion de stock</title>
	</head>
	<body>
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
            // On récupère les données
            $reponse = $bdd->query("SELECT fournisseur.societe as nom, sum(prixunitaire*unitesstock) as total  
                            FROM produit  
                            inner join fournisseur  
                            on fournisseur.numfournisseur=produit.numfournisseur  
                            inner join categorie 
                            on produit.codecategorie=categorie.codecategorie  
                            WHERE categorie.Nomcategorie='Boissons'  
                            GROUP BY fournisseur.societe");
            
            // On affiche chaque entrée une à une
            while ($donnees = $reponse->fetch())
            {
            ?>
                <p><?php echo $donnees['nom']; ?> : <?php echo $donnees['total']; ?></p>
            <?php
            }
            $reponse->closeCursor(); // Termine le traitement de la requête
	    ?>
	</body>
</html>