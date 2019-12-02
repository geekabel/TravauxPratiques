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
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Modification du stock(liste déroulante statique)</title>
    </head>
    <body>
        <?php
        // On mets à jour le stock
        if(isset($_GET['nb']) and isset($_GET['refprod'])){
            $nb=$_GET['nb'];
            $refProd=$_GET['refprod'];
            $bdd->exec("UPDATE produit SET unitesstock = '$nb' WHERE refproduit = '$refProd'");
        }
        ?>
        <h1>Modification du stock</h1>
        <form action="" method="get">
           <p><label>Produit :</label>
           <select name="refprod">
               <option selected>Choisissez...</option>
               <?php
               // On récupère le contenu produit
                $reponse = $bdd->query('SELECT refproduit,nomproduit FROM produit WHERE codecategorie=1');

                // On affiche chaque entrée une à une
                while ($donnees = $reponse->fetch())
                {
                ?>
                <option value="<?php echo $donnees['refproduit'];?>"><?php echo $donnees['nomproduit'];?></option>
                <?php
                }
                $reponse->closeCursor(); // Termine le traitement de la requête
                ?>
           </select>
           </p>
           <p>
           <label>Quantité :</label><input type="number" name="nb" min="0">
            <input type="submit" name="modif" value="Modifier">
            </p>
        </form>    
    
    </body>
</html>