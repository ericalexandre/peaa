<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecognitionService
 *
 * @author Asus
 */
class RecognitionService {
	
	private $o_gt;
	
	
	function __construct(Gateway $o_gt) {
		$this->o_gt = $o_gt;
	}
	
	
	public function recognizedRevenue($contractNumber, $asOf) {

		$a_rrs = $this->o_gt->findRecognitionsFor($contractNumber, $asOf);
		$amount = 0.00;
		foreach ($a_rrs as $a_rr) {
			$amount += $a_rr['amount'];
		}
		return $amount;
		
	}
	
	public function calculateRevenueRecognitions($contractNumber) {
      
         $a_ct = $this->o_gt->findContract($contractNumber);
		 $totalRevenue = round($a_ct["revenue"],2);
		 $recognitionDate = $a_ct["dateSigned"];
		 $type = $a_ct["type"];
		 
		// reco + 30 days
		$o_date_1 = new DateTime($recognitionDate);		
		$o_dateInterval_1 = DateInterval::createFromDateString($o_date_1->format('Y-m-d H:i:s'));
		$o_dateInterval_1->d = '30';
		$o_date_1->add($o_dateInterval_1);
		$recognitionDate_1 =  $o_date_1->format('Y-m-d H:i:s');			
		// reco + 60 days
		$o_date_2 = new DateTime($recognitionDate);		
		$o_dateInterval_2 = DateInterval::createFromDateString($o_date_2->format('Y-m-d H:i:s'));
		$o_dateInterval_2->d = '60';
		$o_date_2->add($o_dateInterval_2);
		$recognitionDate_2 =  $o_date_2->format('Y-m-d H:i:s');
		// reco + 90 days
		$o_date_3 = new DateTime($recognitionDate);		
		$o_dateInterval_3 = DateInterval::createFromDateString($o_date_3->format('Y-m-d H:i:s'));
		$o_dateInterval_3->d = '90';
		$o_date_3->add($o_dateInterval_3);
		$recognitionDate_3 =  $o_date_3->format('Y-m-d H:i:s');
		
		// split revenue in 3 parts
		$allocation_1 = round($totalRevenue/3,2);
		$allocation_2 = round($totalRevenue/3,2);
		$allocation_3 = round($totalRevenue - ($allocation_1 + $allocation_2),2);		
		

         if ($type==="S"){            
			$this->o_gt->insertRecognition($contractNumber, $allocation_1, $recognitionDate);
			$this->o_gt->insertRecognition($contractNumber, $allocation_2, $recognitionDate_2);
			$this->o_gt->insertRecognition($contractNumber, $allocation_3, $recognitionDate_3);
         }else if ($type==="W"){
            $this->o_gt->insertRecognition($contractNumber, $totalRevenue, $recognitionDate);
         }else if ($type==="D") {
            $this->o_gt->insertRecognition($contractNumber, $allocation_1, $recognitionDate);
			$this->o_gt->insertRecognition($contractNumber, $allocation_2, $recognitionDate_1);
			$this->o_gt->insertRecognition($contractNumber, $allocation_3, $recognitionDate_2);
         }
   }
	
}
