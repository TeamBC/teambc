<?php 

require_once ('class_perso.php');
require_once ('class_queen.php');

class Cersei extends Queen {
    public function __construct()
    {
        $this->pet = new Pet('Jaime', 5);
    }


    
    public function chance_hit(){

    }

    public function attack_1(){

        

    }

    public function attack_2(){
        
    }

    public function attack_special(){

    }

    public function critical_strike(){
        
    }

}