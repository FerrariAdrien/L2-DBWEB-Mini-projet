<?php
    session_start();
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
            <div class="w3-bar w3-theme">
                <a href="etatsdesventes.php" class="w3-bar-item w3-button">ventes</a>
            </div>
            <table>
                
<?php
    include ('classeuti.php');
    include ('connexion.php');
    include ('classtickets.php');
    include ('classproduit.php');
    include ('classticketsentry.php');


    
    
    $reponse = $conn->query('select utilisateurs.nom from utilisateurs
    inner join tickets on utilisateurs.id = tickets.utilisateur_id
    where tickets.id = any(select ticket_entry.ticket_id  from ticket_entry inner join produits on ticket_entry.produit_id = \'' . $_GET['id'] . '\')
    group by utilisateurs.nom');

$reponse->SeTFetchMode(PDO::FETCH_CLASS,'utilisateurs');
//tableau qui va contenir tous les utilisateurs de la bdd.
$tab = array();
while ($donne = $reponse->fetch()){
    array_push($tab,$donne);
}
echo '<br />';
if($tab!=NULL){
    foreach ($tab as $i){
        $t =$i->getName();
        echo 
        "
            <tr>
            <td>$t</td>
            </tr>
        ";
    }
}
?>

</table>
</html>