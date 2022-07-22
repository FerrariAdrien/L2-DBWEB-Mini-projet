<?php
class categories{
    private $nom;
    private $id;

    public function __construct($id,$nom){
        $this->nom = $nom;
        $this->id = $id;
    }

    public function getName(){
        return $this->nom;
    }
    public function getId(){
        return $this->id;
    }

    public function __toString(){
        return  "<tr>
        <td>$this->id</td>
        <td>$this->nom</td>
        <td class=disp>
        ";
    }
}
?>