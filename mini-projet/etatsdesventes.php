<?php
    session_start();
    if ($_SESSION['loggedin']==0){
        header("Location: utilisateurs.php");

        
    }

    include 'connexion.php';
    include 'classproduit.php';
    $reponse = $conn->query('select produits.nom,produits.id,produits.prix,produits.categorie_id, sum(ticket_entry.quantite) as total from produits
    inner join ticket_entry on produits.id = ticket_entry.produit_id
    group by produits.nom,produits.id');

    $reponse->SeTFetchMode(PDO::FETCH_CLASS,'produits');
//tableau qui va contenir tous les utilisateurs de la bdd.
$tab = array();
while ($donne = $reponse->fetch()){
    array_push($tab,$donne);
}
echo '<br />';


function trie($tab){
    for($i=0;$i < sizeof($tab)-1;$i++){
        for($j=0;$j < sizeof($tab)-1-$i;$j++){
            if($tab[$j]->getTotal() < $tab[$j+1]->getTotal()){
                $temp = $tab[$j+1];
                $tab[$j+1] = $tab[$j];
                $tab[$j]=$temp;
            }
        }
    }
    return $tab;
}


// trie de la table sql récuperé

$tab = trie($tab);

?>

<!Doctype html>
    <html>
            <head>
                <link rel=stylesheet href=https://www.w3schools.com/w3css/4/w3.css>
                <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-red.css">
            <style>
                table,td{
                     border: 1px solid;
                }
            </style>
            </head>
            <body>
            <!--bar de navigation -->
            <div class="w3-bar w3-theme-d3">            
                <a href="utilisateurs.php" class="w3-bar-item w3-button">utilisateur</a>
            </div>
            <?php
                if($_SESSION['admin']==0){
                   echo" <p>pour avoir acces à utilisateurs par produit il faut étre admin vous ne l'etes pas </p>";
                }
            ?>
           

            <table class='test w3-table w3-striped w3-padding-64'>
            <tr class='w3-theme'>
                <th>id</th>
                <th>nom</th>
                <th>prix</th>
                <th>categorie_id</th>
                <th>quantite</th>
            </tr>
        <?php
            foreach($tab as $i){
                    echo $i;
                    $idproduit = $i->getId();
                
                   
                    if ($_SESSION['admin'] == 1){

                        echo"<td><a href=utilisateursparproduits.php?id=$idproduit class='w3-bar-item w3-button'>utilisateurs</a></td>";
                    }
                    
                }
        ?>
        </table>
            </body>

    </html>