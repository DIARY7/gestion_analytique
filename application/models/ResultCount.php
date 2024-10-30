<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResultCount extends CI_Model {
    public $centreOperationnel = array();
    public $nombre;
    public $coutTotaux;
    public $coutPiece;
    public $uniteOeuvre;

    public function __construct() {
        parent::__construct();
        
    }
    public function constructeur($nombre){
        $this->load->model("repartition");
        $this->nombre = $nombre;
        $this->uniteOeuvre = "Piece T-shirt";
        $this->calculateResultCout();
        $this->calculateCoutPiece();
        return $this;
    }
    public function calculateResultCout() {
        $total = 0;
        for ($i=0; $i < count($this->repartition->centreOperationnel) ; $i++) { 
            $this->centreOperationnel[] = $this->repartition->centreOperationnel[$i];
            $total+= $this->repartition->coutTotal[$i];
        }
        $this->coutTotaux = $total;    
    }
    public function calculateCoutPiece() {
        $this->coutPiece = ($this->coutTotaux / $this->nombre);
    }

	public function seuilRentabilite($nb_Tshirt,$marge, $coutPiece) {
		$rentabilite = ($marge+$coutPiece)*$nb_Tshirt;
		return $rentabilite; 
	}
}
