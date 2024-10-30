<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RubriqueController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('rubrique');
        $this->load->model('secteur');
    }
	public function index()
	{
        $data = array();
        $data["secteurs"] = $this->secteur->getAllSecteur();
        $data["natures"] = $this->rubrique->getAllNature();
        $data["ok"] = NULL;
        $this->load->view("page/insert-rubrique.php",$data);
	}
    public function insertRubrique () {
        $nom = $this->input->post("nom");
        $total =  $this->input->post("total");
        $uniteOeuvre = $this->input->post("uniteOeuvre");
        $idNature = $this->input->post("idNature");
        
        $lastIdRubrique = $this->rubrique->insertRubrique($nom,$total,$uniteOeuvre,$idNature);
        $secteurs = $this->secteur->getAllSecteur();
        $data = array();
        $data["secteurs"] = $this->secteur->getAllSecteur();
        $data["natures"] = $this->rubrique->getAllNature();
        for ($i=0; $i < count($secteurs) ; $i++) { 
            if ($this->input->post("check".$secteurs[$i]["idSecteur"])!==null) {
                try {
                    $this->rubrique->insertRubriqueSecteur ($lastIdRubrique,$secteurs[$i]["idSecteur"],$this->input->post("percent".$secteurs[$i]["idSecteur"]));
                } catch (\Throwable $th) {
                    $data["ok"] = false;
                    $this->load->view("page/insert-rubrique.php",$data);
                    return;
                }
            }
        }
        $data["ok"] = true;
		$this->load->view("page/insert-rubrique.php",$data);
    }

    public function vuRubSect() {
        $data = array();
		$rubSectInstance = (new RubSect())->constructeur();
        
        $data["tabRubrique"] = $this->rubrique->getTableauInfoRubrique();
        $data["secteurs"] = $this->secteur->getAllSecteur();
		$data['totalRubrique'] =  $this->rubrique->getTotalRubrique();
        $data["rubsecteurs"] = $rubSectInstance->rubSecteurs;
        $data['coutTotalSecteur'] = $rubSectInstance->coutTotalSecteur;
		$data['coutParNature'] = $rubSectInstance->coutTotalSecteurParNature;
		$data['coutTotalFV'] = $rubSectInstance->getTotalCoutFV();

        $this->load->view("page/tab-rubrique", $data);
    }

    public function testInsert () {
        
        //$this->rubrique->insertRubriqueSecteur(4,2,40);
    }
    public function input(){
        $this->load->view("input");
    }
    
}
