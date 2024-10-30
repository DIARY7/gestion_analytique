<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResultController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('resultCount');
		$this->load->model('repartition');
    }

    public function toForm() {
        $this->load->view("page/insert-nombre");
    }

    public function getResultat(){
        $nombre = $this->input->get("nombre");
        $marge = $this->input->get("marge");
        $tabRusult = (new ResultCount())->constructeur($nombre);
        $data = array();
        $data["resultCount"] = $tabRusult;
        $data["repartition"] = new Repartition();
        $seuil = $this->resultCount->seuilRentabilite($nombre,$marge,$tabRusult->coutPiece);
		$data["seuil"] = $seuil;

        $this->load->view("page/tab-final-result",$data);

    }
}
