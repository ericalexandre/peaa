<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RevenueRecognition
 *
 * @author Asus
 */
class RevenueRecognition {
	//put your code here
	private $amount;
	
	private $date;
	
	function __construct($amount, $date) {
		$this->amount = $amount;
		$this->date = $date;
	}
	
	function getAmount() {
		return $this->amount;
	}
	
	public function isRecognizableBy($asOf) {	
		$o_asOf = new DateTime($asOf);
		$o_recognitionDate = new DateTime($this->date);
		$diff = $o_asOf->getTimestamp() - $o_recognitionDate->getTimestamp();
		return ($diff>=0);
   }
	
	



	
	
}
