<?php


require_once ('class_perso.php');

class White_Walker extends Perso {

	protected $ice_resitance;
	protected $nb_perso;
	protected $degats_down;
	protected $life_points;

    public function getIceResitance()
    {
        return $this->ice_resitance;
    }

    public function setIceResitance($ice_resitance)
    {
        $this->ice_resitance = $ice_resitance;

        return $this;
    }

    public function getNbPerso()
    {
        return $this->nb_perso;
    }

    public function setNbPerso($nb_perso)
    {
        $this->nb_perso = $nb_perso;

        return $this;
    }

    public function getDegatsDown()
    {
        return $this->degats_down;
    }

    public function setDegatsDown($degats_down)
    {
        $this->degats_down = $degats_down;

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