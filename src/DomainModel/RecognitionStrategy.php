<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecognitionStrategy
 *
 * @author Asus
 */
abstract class RecognitionStrategy {
	abstract function calculateRevenueRecognitions(\Contract $contract);
}
