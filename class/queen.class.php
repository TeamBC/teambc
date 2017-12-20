<?php 

require_once ('class_perso');

class Queen extends Perso {

    protected $pet;

    public function petAttack()
    {
        $damage = $this->pet->getDamage();
    }

	public function heal(){

	}

    public function getFamilier()
    {
        return $this->familier;
    }

    public function setFamilier($familier)
    {
        $this->familier = $familier;

        return $this;
    }
}
