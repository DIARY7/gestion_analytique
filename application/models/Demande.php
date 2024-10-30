<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demande extends CI_Model {
    public function __construct() {
        parent::__construct();       
    }

    public function getCommandeNonSatisfait() {
        $this->db->select('*');
        $this->db->from('v_demande_charge d');
        $this->db->where("d.id NOT IN (SELECT dc.id_demande FROM demande_confirmer dc)", NULL, FALSE);
        $this->db->or_where("d.id IN (SELECT d.id FROM v_demande_confirmer WHERE (quantite - reste) != 0)", NULL, FALSE);
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    }
    
    public function insertDemande($id_profil,$id_charge,$quantite,$daty){
        $data = array(
            'id_profil' => $id_profil,
            'id_charge' => $id_charge,
            'quantite'  => $quantite,
            'daty'      => $daty
        );
        return $this->db->insert('demande', $data);
    }

    public function confirmeDemande($id_demande,$nbre,$daty){
        $reste = (double)$string - (double) $nbre;
        $data = array(
            'id_demande' =>$id_demande,
            'daty' => $daty,
            'reste' =>$reste
        );
        return $this->db->insert('demande_confirmer', $data);
    }
}