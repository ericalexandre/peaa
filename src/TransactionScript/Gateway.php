<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gateway
 *
 * @author Asus
 */
class Gateway {
	
	private $cnx;
	
	function __construct(PDO $cnx) {
		$this->cnx = $cnx;
	}


	public function findRecognitionsFor($contractID, $asOf){		

		$stmt = $this->cnx->prepare(self::findRecognitionsStatement());
		$stmt->BindParam(1,$contractID) ;
		$stmt->BindParam(2,$asOf) ;
		if($stmt->execute() === FALSE){
			echo "Il y a une erreur dans votre requête sql :\n";
			print_r($this->cnx->errorInfo());
			echo $this->cnx->errorCode()."\n";
			exit();
		}
		$result = $stmt->fetchAll();
		$stmt = NULL;
		return $result;
	}
   
	
	private static final function findRecognitionsStatement(){
		$query = "SELECT amount ". 
		"FROM revenueRecognitions ".
		"WHERE contract = ? AND recognizedOn <= ?";
		return $query;	  
	}
   
	
	public function findContract($contractID) {
		$stmt = $this->cnx->prepare(self::findContractStatement());
		$stmt->BindParam(1,$contractID) ;
		if($stmt->execute() === FALSE){
			echo "Il y a une erreur dans votre requête sql :\n";
			print_r($this->cnx->errorInfo());
			echo $this->cnx->errorCode()."\n";
			exit();
		}
		$result = $stmt->fetchAll();
		$row = $result[0];
		$stmt = NULL;
		return $row;
	}
   
	
   private static final function findContractStatement() {
      $query = "SELECT * ".
      "FROM contracts c, products p ".
      "WHERE c.ID = ? AND c.product = p.ID";
	  return $query;
   }
   
   
	public function insertRecognition ($contractID, $amount, $asOf) {
		$stmt = $this->cnx->prepare(self::insertRecognitionStatement());
		$stmt->BindParam(1,$contractID) ;
		$stmt->BindParam(2,$amount) ;
		$stmt->BindParam(3,$asOf) ;
		if($stmt->execute() === FALSE){
			echo "Il y a une erreur dans votre requête sql :\n";
			print_r($this->cnx->errorInfo());
			echo $this->cnx->errorCode()."\n";
			exit();
		}
	}
   
	private static final function insertRecognitionStatement() {
		$query = "INSERT INTO revenueRecognitions VALUES (?, ?, ?)";
		return $query;
	}
	
	
}
