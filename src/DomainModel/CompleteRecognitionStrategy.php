<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompleteRecognitionStrategy
 *
 * @author Asus
 */
class CompleteRecognitionStrategy extends \RecognitionStrategy {
	
	public function calculateRevenueRecognitions(\Contract $contract) {
		$contract->addRevenueRecognition(new \RevenueRecognition($contract->getRevenue(), $contract->getWhenSigned()));
	}

//put your code here
}
