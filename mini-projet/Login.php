<!Doctype html>
            <html>
            <head>
                <link rel=stylesheet href=https://www.w3schools.com/w3css/4/w3.css>
            <style>
                table,td{
                     border: 1px solid;
                }
            </style>
            </head>
            <body>
                <!-- navbar-->
            <div class="w3-bar w3-black">
                <a href="utilisateurs.php" class="w3-bar-item w3-button">utilisateur</a>
            </div>
            <form class=w3-container action="" method=POST>
         <p>
        <input class=w3-input type=text name=login>
        <label>Login</label></p>
        <p>     
        <input class=w3-input type=text name=mdp>
        <label>Mot de passe</label></p>
        <input type=submit>
    </form>


<?php
    session_start();
    include 'connexion.php';
    // recuperation login et mdp pour connexion de l'utilisateur
    @$login = $_POST['login'];
    @$mdp = $_POST['mdp'];
    //connexion utilisateurs.
    if(isset($login) && isset($mdp)){
        $test = $conn->query('select * from utilisateurs');
            while($connex = $test->fetch()){
                //test si l'utilisateur est bien dans la base de donnée.
                if($connex['nom'] == $login && $connex['id']== $mdp){
                    echo"connexion reussis";
                    //mise a jour des variables de session de l'utilisateur.
                    $_SESSION['nom'] = $connex['nom'];
                    $_SESSION['admin'] = $connex['admin'];
                    $_SESSION['loggedin'] = 1;
                }
            }
        }
    
?>