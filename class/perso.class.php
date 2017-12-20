<?php

class Perso{
	protected $name;
	protected $lifePoints;
	protected $damage;


    public function getDamage()
    {
        return $this->damage;
    }
 
    public function setDamage($damage)
    {
        $this->damage = $damage;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getLifePoints()
    {
        return $this->lifePoints;
    }

    public function setLifePoints($lifePoints)
    {
        $this->lifePoints = $lifePoints;

        return $this;
    }

    public function attack(Perso $perso_attaquer){
    	$perso_attaquer->hit($this->getDamage());
    }

    public function hit($damage)
    {
    	$this->setLifePoints($this->getLifePoints() - $damage);
    	if ($this->getLifePoints() <= 0) {
    		$this->die();
    	}
    }

    abstract function attackSpecial();

    public function defend(){
    	
    }

    public function accuracy(){
    	
    }

    public function critical(){
    	
    }
}

