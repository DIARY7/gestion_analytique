<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rubrique extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('rubSect');
    }

    public function insertRubrique($nom,$total,$uniteOeuvre,$idNature){
        
        $sql = "INSERT INTO rubrique(nom,total,uniteOeuvre,idNature) VALUES (%s,%f,%s,%d)";
        $sql = sprintf($sql,$this->db->escape($nom),$total,$this->db->escape($uniteOeuvre),$idNature);
        $this->db->query($sql);
        return $this->db->insert_id();
    }
    public function insertRubriqueSecteur ($idRubrique,$idSecteur,$pourcentage) {
        $sql = "SELECT total from rubrique where idRubrique = %d Limit 1";
        $sql = sprintf($sql,$this->db->escape($idRubrique));
        $totalRubrique = ($this->db->query($sql))->row_array()["total"];
        $cout = ($pourcentage*$totalRubrique)/100;
        $insert = "INSERT INTO rubriqueSecteur(idRubrique,idSecteur,pourcentage,cout) VALUES (%d,%d,%f,%f) ";
        $insert = sprintf($insert,$idRubrique,$idSecteur,$pourcentage,$cout);
        $this->db->query($insert);
    }
    /* Ilay tokony antsoina any @ controlleur */
    public function getAllNature () {
        $query = $this->db->get('nature');  // 'users' est le nom de la table
        return $query->result_array();  // Retourne un tableau d'objets
    }
    public function getTableauInfoRubrique() {
        $sql1 = "SELECT * FROM Vrubrique ";
        $sql2 = "SELECT * from rubriqueSecteur where idRubrique = %d";
        $rubriques = ($this->db->query($sql1))->result_array();
        $data = [];

        foreach ($rubriques as $rubrique) {
            $rub = new RubSect();
            $rub->rubrique = $rubrique;
            
            $sql = sprintf($sql2,$this->db->escape($rubrique["idRubrique"]));
            $query = $this->db->query($sql);
            foreach ($query->result_array() as $secteur) {
                $rub->secteur = $secteur;
            }
            $data[] = $rub; 
        }

        return $data;
    }

	//Total des charges des rubriques
	public function getTotalRubrique(){
		$this->db->select_sum('cout'); 
        $query = $this->db->get('rubriqueSecteur'); 
        return $query->row()->cout;
	}
			
}
