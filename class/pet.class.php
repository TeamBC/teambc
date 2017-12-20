<?php

class Pet
{
	protected $name;

	protected $damage;

	public function __construct($name, $damage)
	{
		$this->name = $name;
	}

	public function attack()
	{
		# code...
	}
}