<?php
class tickets{
    private $id;
    private $date;
    private $utilisateur_id;

    public function __construct(){

    }

    public function getId(){
        return $this->id;
    }

    public function getuti(){
        return $this->utilisateur_id;
    }

    public function __toString(){
        return "

        <tr>
          <td>$this->id</td>
          <td>$this->date</td>
          <td>$this->utilisateur_id</td>    
          ";
    }
}
?>