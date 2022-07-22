<?php
  session_start();
  
?>
<!Doctype html>
            <html>
            <head>
                <link rel=stylesheet href=https://www.w3schools.com/w3css/4/w3.css>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
                <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-red.css">
            <style>
           
                table,td{
                     border: 1px solid;
                      
                }
                #tableau tr td {
                  border: solid 1px silver;
                }
                 #tableau {
            border-collapse: collapse;
        }
                .disp{ 
                  display : block;
                }

            
                #zoom {
                  display : none;
	}
            
            </style>
            </head>
            <body>
              <!--navbar-->
            <div class="w3-bar w3-theme-d3">
                <a href="etatsdesventes.php" class="w3-bar-item w3-button">ventes</a>
                <a href="utilisateurs.php"class="w3-bar-item w3-button">Retour</a>
            </div>

            

<?php
 include 'connexion.php';
 include 'classtickets.php';
 include 'classproduit.php';
 include 'classticketsentry.php';


    //recuperation des tickets corresepondant a l'id de l'utilisateur.
    $ti = $conn->query('select * from tickets where utilisateur_id=\'' . $_GET['id'] . '\' order by date');
    $ti->SeTFetchMode(PDO::FETCH_CLASS,'tickets');
    if($ti->fetch()!=NULL){
      echo"
      <table id=tableau  class='test w3-table w3-striped w3-padding-64'>
      <tr class='w3-theme'>
          <th>id</th>
          <th>date</th>
          <th>utilisateur_id</th>
          <th class=disp>produits</th>
      </tr>";
      //recuperation des produits de chaque tickets de l'utilisateur.
    while ($donne = $ti->fetch()){
        $id = $donne->getId();
        $prod =  $conn->query("select produits.nom from produits inner join categories ON produits.categorie_id=categories.id where produits.id=ANY(select produit_id from ticket_entry where ticket_id=$id) order by  categories.id;");
        $prod->SeTFetchMode(PDO::FETCH_CLASS,'produits');
        ;
        echo $donne;
        echo "<td class=disp>";
        //affichage dans le tableau des produits.
        while ($produit = $prod->fetch()){
          
        echo $produit->getName();
          echo "<br>";
        }
        echo "</td>
        </tr>";
    }
  }
  else {
    echo "Aucun ticket de caisse pour cet utilisateur";
  }

  


?>


  
</table>
<!--tableau qui va servir pour le zoom-->
<table id="zoom">
  
<tr>
          <td></td>
          <td></td>
          <td></td>    
          <td></td>
</tr>
</table>
<h2></h2>

<button class="monbouton">enlever/afficher</button>

<script>

  //Zoom sur le tickets ou est la souris;
  $('#tableau tr').mouseover(function(){
    var td = $(this).find('td');
    for(i=0;i<td.length;i++){
      var txt = $(td).eq(i).text();
      $('#zoom tr td').eq(i).html(txt);
    }
    $('#zoom td').css({width : "100%",height : "100%"});
    $('#zoom').css("display","block");
  });



  $(".monbouton").click(function(){
    var change = $(".disp").css("display");
    if(change=="block"){
      $(".disp").css("display","none");
    }
    else {
      $(".disp").css("display","block");
    }
    });

    
</script>
</body>

</html>