<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <title>Gestion de stock : Afficher tableau graphique</title>
	    <style>
	        h1{text-align:center;}
	        table{
	            border-collapse:collapse;
	            margin:auto;
	            margin-bottom:20px;
	        }
	        td,th{
	            border:1px solid black;
	            padding:5px;
	        }
	    </style>
	</head>
	<body>
	    <h1>Résultat tableau</h1>
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
            ?>
            <table>
                <tr><th>Fournisseur</th><th>Cout</th></tr>
            <?php
            $coutStock=0;
            // On affiche chaque entrée une à une
            while ($donnees = $reponse->fetch())
            {
                 $coutStock+=$donnees['total'];
            ?>
                <tr>
                    <td><?php echo $donnees['nom']; ?></td><td><?php echo $donnees['total']; ?></td>
                </tr>
            <?php
            }?>
            <tr>
                <td><strong>Total</strong></td><td><strong><?php echo $coutStock; ?></strong></td>
            </tr>
            <?php
            $reponse->closeCursor(); // Termine le traitement de la requête
	    ?>
	        </table>
	        <?php
	        // On récupère les données
            $reponse = $bdd->query("SELECT fournisseur.societe as nom, sum(prixunitaire*unitesstock) as total  
                            FROM produit  
                            inner join fournisseur  
                            on fournisseur.numfournisseur=produit.numfournisseur  
                            inner join categorie 
                            on produit.codecategorie=categorie.codecategorie  
                            WHERE categorie.Nomcategorie='Boissons'  
                            GROUP BY fournisseur.societe");
            ?>
	        <table>
                <tr><th>Fournisseur</th><th>Cout</th><th>%</th></tr>
            <?php
            // On affiche chaque entrée une à une
            while ($donnees = $reponse->fetch())
            {
                 $pourcentage=($donnees['total']/$coutStock)*100;
                 $pourcentage=round($pourcentage,2);
                 $width=($pourcentage*600)/100;
                 $width=round($width);
            ?>
                <tr>
                    <td><?php echo $donnees['nom']; ?></td><td><hr align="left" size="10px" width="<?php echo $width?>px" color="blue"></td><td><?php echo $pourcentage?> %</td>
                </tr>
            <?php
            }?>
            <?php
            $reponse->closeCursor(); // Termine le traitement de la requête
	    ?>
	        </table>
	</body>
</html>