<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contract
 *
 * @author Asus
 */
class Contract {
	//put your code here
	private $revenueRecognitions;
	
	private $o_product;
	
    private $revenue;
    
	private $whenSigned;
    
	private $id;
   
	
	function getRevenue() {
		return $this->revenue;
	}

	function getWhenSigned() {
		return $this->whenSigned;
	}

		
	function __construct(\Product $o_product, $revenue, $whenSigned) {
		$this->revenueRecognitions = array();
		$this->o_product = $o_product;
		$this->revenue = $revenue;
		$this->whenSigned = $whenSigned;
	}

	
	public function recognizedRevenue($asOf) {
      $result = 0.00;
	  foreach ($this->revenueRecognitions as $o_rr) {
		  if($o_rr->isRecognizableBy($asOf)) {
			  $result += $o_rr->getAmount();
		  }  
	  }
      return $result;
   }
   
   public function addRevenueRecognition(\RevenueRecognition $o_revenueRecognition) {
	   $this->revenueRecognitions[] = $o_revenueRecognition;
   }
   
    public function calculateRecognitions() {
      $this->o_product->calculateRevenueRecognitions($this);
   }
   
	
}
