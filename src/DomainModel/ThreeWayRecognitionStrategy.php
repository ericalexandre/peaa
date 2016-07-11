<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ThreeWayRecognitionStrategy
 *
 * @author Asus
 */
class ThreeWayRecognitionStrategy extends \RecognitionStrategy {
	
	private $firstRecognitionOffset;
	
	private $secondRecognitionOffset;
	
	function __construct($firstRecognitionOffset, $secondRecognitionOffset) {
		$this->firstRecognitionOffset = $firstRecognitionOffset;
		$this->secondRecognitionOffset = $secondRecognitionOffset;
	}

	
	
	
	public function calculateRevenueRecognitions(\Contract $contract) {
		
		// reco + 30 days
		$o_date_1 = new DateTime($contract->getWhenSigned());		
		$o_dateInterval_1 = DateInterval::createFromDateString($o_date_1->format('Y-m-d H:i:s'));
		$o_dateInterval_1->d = $this->firstRecognitionOffset;
		$o_date_1->add($o_dateInterval_1);
		$recognitionDate_1 =  $o_date_1->format('Y-m-d H:i:s');			
		// reco + 60 days
		$o_date_2 = new DateTime($contract->getWhenSigned());		
		$o_dateInterval_2 = DateInterval::createFromDateString($o_date_2->format('Y-m-d H:i:s'));
		$o_dateInterval_2->d =$this->secondRecognitionOffset;
		$o_date_2->add($o_dateInterval_2);
		$recognitionDate_2 =  $o_date_2->format('Y-m-d H:i:s');
		
		// split revenue in 3 parts
		$totalRevenue = round($contract->getRevenue(),2);
		$allocation_1 = round($totalRevenue/3,2);
		$allocation_2 = round($totalRevenue/3,2);
		$allocation_3 = round($totalRevenue - ($allocation_1 + $allocation_2),2);	
		
		$contract->addRevenueRecognition(new \RevenueRecognition($allocation_1, $contract->getWhenSigned()));
		$contract->addRevenueRecognition(new \RevenueRecognition($allocation_2, $recognitionDate_1));
		$contract->addRevenueRecognition(new \RevenueRecognition($allocation_3, $recognitionDate_2));
		
		
		
	}

//put your code here
}
