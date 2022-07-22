<?php
class produits{
    private $id;
    private $nom;
    private $prix;
    private $categorie_id;
    public $total;

    public function __construct(){
    
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return  $this->nom;
    }

    public function getPrix(){
        return $this->prix;
    }

    public function getCategorie(){
        return $this->categorie_id;
    }

    public function getTotal(){
        return $this->total;
    }
    public function __toString(){
        return " <tr>
        <td>$this->id</td>
        <td>$this->nom</td>
        <td>$this->prix</td>
        <td>$this->categorie_id</td>
        <td>$this->total</td>
        ";
    }
}


/*select produits.nom,produits.id,produits.prix,produits.categorie_id, count(ticket_entry.quantite) from produits
inner join ticket_entry on produits.id = ticket_entry.produit_id
group by produits.nom;
*/
?>


