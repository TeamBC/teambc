<?php

require_once ('class_perso.php');

class Night_walker extends Perso{

	private $hit;
	private $life_points;

    public function getHit()
    {
        return $this->hit;
    }

    public function setHit($hit)
    {
        $this->hit = $hit;

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