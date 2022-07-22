<?php

class utilisateurs{
    private $nom;
    private $id;
    private $prenom;
    private $admin;
    public function __construct(){

    }

    public function getName(){
        return $this->nom;
    }
    public function getId(){
        return $this->id;
    }


    public function getPrenom(){
        return $this->prenom;
    }
    public function setadmin($var){
        $this->admin = $var;
        
    }
    public function getadmin(){
        return $this->admin;
    }
    public function __toString(){
       return "
    
       <tr>
       <td>$this->id</td>
       <td>$this->prenom</td>
       <td id=nom ad=$this->admin>$this->nom</td>
       <td id=admin >$this->admin</td>
       <td><a href=tickets.php?id=$this->id class='w3-button'>ticket</a></td>
       </tr>
    ";
    }

}

?>