<?php
class Ticketsentry{
    private $id;
    private $ticket_id;
    private $produit_id;
    private $quantite;

    public function __construct(){
        /*
        $this->id = $id;
        $this->ticket_id = $ticketsid;
        $this->produit_is = $prodId;
        $this->quantite = $quantite;
        */
    }

    public function getid(){
        return $this->id;
    }

    public function getTicketId(){
        return $this->ticket_id;
    }

    public function getProduitId(){
        return $this->produit_id;
    }

    public function getQuantite(){
        return $this->quantite;
    }

    public function __toString(){
        return "

        <tr>
          <td>$this->id</td>
          <td>$this->ticket_id</td>
          <td>$this->produit_id</td>
          <td>$this->quantite</td>
          <td class=disp>
          ";
    }
}
?>