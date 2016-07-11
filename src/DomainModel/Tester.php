<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tester
 *
 * @author Asus
 */
class Tester {
	//put your code here
	private $word;
	
	private $calc;
	
	private $db;
	
	private $contract_1;
	
	private $contract_2;
	
	private $contract_3;
	
	
	
	public function run() {
		$this->word = Product::newWordProcessor("Thinking Word");
		$this->calc = Product::newSpreadsheet("Thinking Calc");
		$this->db = Product::newDatabase("Thinking DB");
		
		
		$this->contract_1 = new Contract($this->word, '200.50', '2016-07-02 10:00:00');
		$this->contract_2 = new Contract($this->calc, '350.00', '2016-07-04 10:00:00');
		$this->contract_3 = new Contract($this->db, '299.95', '2016-07-03 14:00:00');
		
		
		$this->contract_1->calculateRecognitions();
		$this->contract_2->calculateRecognitions();
		$this->contract_3->calculateRecognitions();
		
		
		// asOf
		$o_date = new DateTime();
		$o_dateInterval = DateInterval::createFromDateString($o_date->format('Y-m-d H:i:s'));
		$o_dateInterval->d = '100';
		$o_date->add($o_dateInterval);
		$asOf =  $o_date->format('Y-m-d H:i:s');	
		
		echo $this->contract_1->recognizedRevenue($asOf)."\n";
		echo $this->contract_2->recognizedRevenue($asOf)."\n";
		echo $this->contract_3->recognizedRevenue($asOf);
		
		
		
	}

	
	
	
}
