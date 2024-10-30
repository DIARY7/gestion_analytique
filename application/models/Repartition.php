<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Repartition extends CI_Model { /* Tableau repartition */
    public $centreOperationnel=array(); /* Liste */
    public $cles=array(); /* Par centre */
    public $distribution=array(); /* Par rapport a admin */
    public $centreOrg=array(); /* Tokony tableau fa atao admin alony izy eto */
    public $coutTotal=array(); /* Tableau cout Total an'ilay centre */

    public function __construct() {
        parent::__construct();
        $this->load->model("secteur");
        $this->setCentreOperationnel();
        $this->setCentreOrg();
        $this->calculateCles();
        $this->calculateDitribution();
        $this->getCoutTotal();
    }

    public function getTotalCoutDirect(){
        $total = 0;
        for ($i=0; $i < count($this->centreOperationnel) ; $i++) { 
            $total+=$this->centreOperationnel[$i]->getTotalCout();
        }
        return $total;
    }
    public function setCentreOperationnel(){
        /* Gettena izay centre operationnel */
        // $centre1 = array();
        // $centre2 = array();
        // $centre1["id"] = 1;
        // $centre1["nom"] = "Centre1";
        // $centre2["id"] = 2;
        // $centre2["nom"] = "Centre2";
        // $centreOp = array();
        // $centreOp[] = $centre1;
        // $centreOp[] = $centre2;
        // for ($i=0; $i < count ($centreOp) ; $i++) { 
        //     $this->centreOperationnel[] = (new Secteur())->constructeur($centreOp[$i]);   
        // }  

		$this->db->where('estOperationnel', 0); 
        $query = $this->db->get('secteur');
        $secteurs = $query->result_array(); 

        $this->centreOperationnel = array();
        foreach ($secteurs as $secteur) {
            $centre = array(
                "id" => $secteur['idSecteur'], 
                "nom" => $secteur['nomination'] 
            );
            $this->centreOperationnel[] = (new Secteur())->constructeur($centre);
        }
        
    }

    public function setCentreOrg(){
        /* Gettena izay centre organisationnel */
        // $centreO=array(
        //     "id" => 3,
        //     "nom" =>"Centre org"
        // );
        
        // $this->centreOrg = (new Secteur())->constructeur($centreO);
		$this->db->where('estOperationnel', 1);
		$query = $this->db->get('secteur');
		$secteurs = $query->result_array(); 

		$centresAssoc = array();
		foreach ($secteurs as $secteur) {
			$centreO = array(
				"id" => $secteur['idSecteur'], 
				"nom" => $secteur['nomination'] 
			);
			$this->centreOrg = (new Secteur())->constructeur($centreO);
			$centresAssoc[] = $centreO;
		}
    }
	
    public function calculateCles(){
        $keys = array();
        for ($i=0; $i < count($this->centreOperationnel) ; $i++) {     
            $keys[] = ((double) ($this->centreOperationnel[$i]->getTotalCout()) / (double) ($this->getTotalCoutDirect()))*100; 
        }
        
        $this->cles=$keys;
        
    }
    public function calculateDitribution(){
        for ($i=0; $i < count($this->cles) ; $i++) { 
            $this->distribution[] = $this->cles[$i]*$this->centreOrg->getTotalCout();                
        }
        
    }
    public function getCoutTotal(){
        for ($i=0; $i < count($this->centreOperationnel) ; $i++) { 
            $this->coutTotal[] = $this->centreOperationnel[$i]->getTotalCout() + $this->distribution[$i]; 
        }
        
    }
    public function getTotalDistribution()  {
        return $this->somme($this->distribution);
        
    }
    public function getTotalCoutTotal() {
        return $this->somme($this->coutTotal);
        
    }
    private function somme($tab) {
        $total = 0;
        for ($i=0; $i < count($tab) ; $i++) { 
            $total+=$tab[$i];
        }
        return $total;
    }

}
?>
