<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RubSect extends CI_Model {
    public $rubSecteurs = array(); // Liste des rubriques avec leurs informations détaillées
    public $coutTotalSecteur = array(); // Coûts totaux par secteur
	public $coutTotalSecteurParNature = array();

	public $coutFixe;
	public $coutVariable;

    public function __construct() {
        parent::__construct();
    }

    public function constructeur() {
        // Initialisation des rubriques par secteur
        $this->rubSecteurs = $this->getRubSecteurs();
        
        // Initialisation des coûts totaux par secteur
        $this->coutTotalSecteur = $this->getCoutTotalSecteur();

		// Initialisation des coûts totaux par secteur et par nature de charge
		$this->coutTotalSecteurParNature = $this->getCoutParSecteurEtNature();

		//Initialisation des totaux des couts variables et fixes
		$this->coutVariable = $this->getTotalCoutVariable();
		$this->coutFixe = $this->getTotalCoutFixe();

        return $this;
    }

    public function getRubSecteurs() {
        // Récupération des données de 'VrubriqueSecteur'
        $query = $this->db->get('VrubriqueSecteur'); 
        return $query->result(); 
    }

    public function getCoutTotalSecteur() {
        // Récupération des coûts totaux par secteur
        $this->db->select('idSecteur, nomination, SUM(cout) as total_cout');
        $this->db->from('VrubriqueSecteur');
        $this->db->group_by('idSecteur');

        $query = $this->db->get();
        $totaux =  $query->result();
        $result = array();
        foreach ($totaux as $total) {
            $totSecteur = array(
                "idSecteur" => $total->idSecteur, 
                "nomination" => $total->nomination,
                "cout" => $total->total_cout      
            );
            $result[] = $totSecteur;
        }
        return $result;
    }

	public function getCoutParSecteurEtNature() {
        $sql = "
            SELECT 
                secteur,
                nature,
                total_cout
            FROM 
                VueCoutParSecteurEtNature
        ";
        $query = $this->db->query($sql);
        
        $resultats = array();
        foreach ($query->result() as $total) {
            $totSecteur = array(
                "secteur" => $total->secteur, 
                "nature" => $total->nature,
                "cout" => $total->total_cout      
            );
            $resultats[] = $totSecteur;
        }
        
        return $resultats;
    }

	public function getTotalCoutVariable() {
		$this->db->select_sum('cout'); 
		$this->db->where('idNature', '1'); 
		$query = $this->db->get('VrubriqueSecteur'); 
		return $query->row()->cout;
	}

	public function getTotalCoutFixe() {
		$this->db->select_sum('cout'); 
		$this->db->where('idNature', '2'); 
		$query = $this->db->get('VrubriqueSecteur'); 
		return $query->row()->cout;
	}

	public function getTotalCoutFV() {
		return $this->coutFixe + $this->coutVariable;
	}
	
	public function getCoutParSecteur($idSecteur) {
        $this->db->select('cout');
        $this->db->from('VrubriqueSecteur');
        $this->db->where('idSecteur', $idSecteur);
        $query = $this->db->get();
        return $query->result_array();  
    }

    public function sommeVerticaleCouts($secteurs) {
        $tableauxCouts = [];
        foreach ($secteurs as $secteur) {
            $tableauxCouts[] = $this->getCoutParSecteur($secteur['idSecteur']);
        }

        $tabSomme = [];
        for ($i = 0; $i < count($tableauxCouts[0]); $i++) {
            $somme = 0;
            foreach ($tableauxCouts as $tab) {
                $somme += $tab[$i]['cout'];
            }

            $tabSomme[] = $somme;
        }

        return $tabSomme;  
    }
}
?>
