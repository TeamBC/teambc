<?php

require_once ('class_perso.php');


class Dothrakis extends Perso {

	protected $degats_up;
	protected $life_points;

    public function getDegatsUp()
    {
        return $this->degats_up;
    }

    public function setDegatsUp($degats_up)
    {
        $this->degats_up = $degats_up;

        return $this;
    }

    public function getLifePoints()
    {
        return $this->life_points;
    }

    public function setLifePoints($life_points)
    {
        $this->life_points = $life_points;

        return $this;
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