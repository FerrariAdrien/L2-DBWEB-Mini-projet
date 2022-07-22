
        <?php
        //fonction de connexion à la base de donnée de l'université.
        function connection(){
            $servername ='pedago01c.univ-avignon.fr';
            $username = 'uapv2002818';
            $password = 'FN0P9Q';
            $nom = "etd";
            $conn = new PDO("pgsql:host=".$servername.";dbname=".$nom.";user=".$username.";password=" .$password);
            if ($conn==NULL){
                throw new Exception('connexion non reussis !');
            }
            return $conn;
        }

            //gere si la connection a été réussite.
            try{
                $conn = connection();
            }
            catch(Exception $e ){
                echo $e->getMessage();
            }
                
        ?>

