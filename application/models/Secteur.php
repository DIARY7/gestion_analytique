<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Secteur extends CI_Model {
    private $totalCout;
    public $nom;
    public $id;

    public function __construct() {
        parent::__construct();
        
    }
    public function constructeur($centre) {
        $this->id= $centre["id"];
        $this->nom=$centre["nom"];
        return $this;
    }
    public function getAllSecteur(){
        $sql = "SELECT * FROM secteur";
        return ($this->db->query($sql))->result_array();
    }
    
    public function calculateCout(){
        /* calcule le totale du cout de ce secteur */
        // $this->totalCout=10000 + $this->id;
		$sql = "SELECT SUM(cout) AS coutRubrique FROM rubriqueSecteur WHERE idSecteur = ?";
		$query = $this->db->query($sql, [$this->id]);
		
		if ($query->num_rows() > 0) {
			$result = $query->row(); // Récupère la première ligne du résultat
			// var_dump($result->coutRubrique);
			return $result->coutRubrique; // Retourne le coutRubrique ou 0 si non défini
		} else {
			return 0; // Retourne 0 si aucun résultat n'est trouvé
		}
    }
    public function getTotalCout() {   
        $this->totalCout = $this->calculateCout();
        return $this->totalCout;
    }
    
}
