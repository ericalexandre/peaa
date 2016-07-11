<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Asus
 */
class Product {
   private $name;
   
   private $o_recognitionStrategy;
   
   function __construct($name, \RecognitionStrategy  $o_recognitionStrategy) {
	   $this->name = $name;
	   $this->o_recognitionStrategy = $o_recognitionStrategy;
   } 
   
   
   public static function newWordProcessor($name) {
      return new Product($name, new \CompleteRecognitionStrategy());
   }
   public static function newSpreadsheet($name) {
      return new Product($name, new \ThreeWayRecognitionStrategy(60, 90));
   }
   public static function  newDatabase($name) {
      return new Product($name, new \ThreeWayRecognitionStrategy(30, 60));
   }
   
   
   public function calculateRevenueRecognitions(\Contract $contract) {
      $this->o_recognitionStrategy->calculateRevenueRecognitions($contract);
   }
   
}
