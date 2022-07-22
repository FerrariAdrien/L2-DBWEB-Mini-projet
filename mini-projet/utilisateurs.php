<?php
    session_start();


?>

<!Doctype html>
            <html>
            <head>
                <link rel=stylesheet href=https://www.w3schools.com/w3css/4/w3.css>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-green.css">
<meta charset="UTF-8">
            <style>
                table,td{
                     border: 1px solid;
                }
            </style>
            </head>
            <body>
                <!-- navbar-->
            <div class="w3-bar w3-theme-d3">
                <a href="etatsdesventes.php" class="w3-bar-item w3-button">ventes</a>

                
<?php
if(isset($_SESSION['loggedin'])){
    
    if ($_SESSION['loggedin']==1 && $_SESSION['admin']==1){
        echo "<button onclick=document.getElementById('id01').style.display='block' class='w3-bar-item w3-button'>ajout/changement</button>";
        echo "<a href=deconnexion.php class='w3-bar-item w3-button'>Deconnexion</a>";
    }

    else{
        echo "<a href=deconnexion.php class='w3-bar-item w3-button'>Deconnexion</a>";
    }
}
else {
        echo "<a href=Login.php class='w3-bar-item w3-button'>Connexion</a>";
    }
?>
</div>
<!--modal a ouvrir pour changer-->
<div class="w3-container">
<div id="id01" class="w3-modal">
<div class="w3-modal-content">
<div class="w3-container">
<span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
<div class="w3-card-4 w3-padding-16">
    <!--formulaire de changment ou d'ajour de personne.-->
    <form class="w3-container w3-padding-16" action="" method="POST">
    
        <input class="w3-input" type="text" name="NewID">
        <label>ID</label></p>
        <label for=nom>Nom :</label>
        <input class=w3-input type=text name=newnom>
        <p>
        <label for=prenom>prenom :</label>
        <input class=w3-input type=text name=newprenom></p>
        <p>
        <label for=adm>Niveau d'admin :</label>
        <input class=w3-input type=text name=newadm></p>
        <input class=w3-button type=submit>
       
    </form>
</div>
</div>
</div>
</div>
</div>
            <table class="test w3-table w3-striped w3-padding-64">
                <tr class="w3-theme">
                    <td>id</td>
                    <td>prenom</td>
                    <td>nom</td>
                    <td>admin</td>
                    <td>ticket</td>
                </tr>
<?php

// connexion à la base de donnée
include 'connexion.php';
include 'classeuti.php';
include 'classtickets.php';
include 'classproduit.php';
include 'classticketsentry.php';


//Récuperation de toutes les données de la bdd et mise dans des variables de session.



//création des utilisateurs et mise dans un tableau $tab. 
// la table utilisateur contient une colonne admin binaire.
$reponse = $conn->query('select * from utilisateurs order by id');

$reponse->SeTFetchMode(PDO::FETCH_CLASS,'utilisateurs');
//tableau qui va contenir tous les utilisateurs de la bdd.
$tab = array();
while ($donne = $reponse->fetch()){
    array_push($tab,$donne);
}
echo '<br />';



//recuperation pour le changement ou ajout d'utilisateur.
    if(isset($_POST['NewID'])){
        $id = $_POST['NewID'];
        $trouver = FALSE;
        $ad = 0;
        foreach($tab as $i){
           if ($id == $i->getId()){
               $ad = $i->getadmin();
               $trouver = TRUE;
               $_SESSION['change'] = $id;
           }
        }
        //si l'utilisateur existe déja et que ce n'est pas un admin.
        if ($trouver == TRUE && $ad!=1){
            echo"
           
            <form class=w3-container w3-card-4  method=POST>
                <p>L'utilisateur existe déjà voulez vous lui changer les droits sur le site</p>
                <p>
                <input class=w3-radio type=radio name=change value=oui>
                <label>Oui</label></p>
                <p>
                <input class=w3-radio type=radio name=change value=non>
                <label>Non</label></p>
                <input class=w3-button type=submit>
            </form>
            ";
        }
        //sinon si c'est un admin je renvoie une erreure.
        elseif ($ad==1){
            echo "impossible c'est un admin";
        }
        //sinon on demande à l'admin les rensignement.
        else{
            $nom = $_POST['newnom'];
            $adm = $_POST['newadm'];
            $prenom = $_POST['newprenom'];
            $cherche = $conn->query('insert into utilisateurs (id,prenom,nom,admin) values (\'' . $id . '\',\'' . $prenom . '\',\'' . $nom . '\',\'' . $adm . '\')');
            echo"ajout bien effectué";
        }
    }
//changement des données d'un utilisateurs.
    if(isset($_POST['change'])){
        $val = $_POST['change'];
        if($val=='oui'){
            $id = $_SESSION['change'];
            $cherche = $conn->query('update utilisateurs set admin = 1 where id= \'' . $id . '\'');
   
        }
    }
    //affichage des objets utilisateurs en tableau.
    if($tab!=NULL){
        foreach ($tab as $i){
            echo $i;

        }
       $tab =  serialize($tab);
        $_SESSION['utilisateur'] = $tab;
    }




?>

</table>
<script>
    //fonction jquery pour gerer la couleur rouge sur les utilisateurs quand on passe la souris dessus.

    $(".test tr").mouseover(function(){
        var td = $(this).find('td');
        for(i = 0;i<td.length;i++){
            var at =$(td).eq(i).attr('ad');
            if(at=='1'){
                $(td).css('color','red');
            }
        }
    });

    //fonction jquery pour gerer la couleur rouge sur l'utilisateur quand le curseur sort de sa case.
    $(".test tr").mouseout(function(){
        var td = $(this).find('td');
        for(i = 0;i<td.length;i++){
            var at =$(td).eq(i).attr('ad');
            if(at=='1'){
                $(td).css('color','black');
            }
        }
    });

</script>
</body>
</html>