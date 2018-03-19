<?php
class Magicien extends Personnage {

    public function critique_attack1()
    {
        $critique = rand(1, 6);
        $degats_crit = 0;

        if($critique > 1){
            $degats_crit = rand(1.5 , 3);
        }
        return $degats_crit;
    } 

    public function critique_attack2()
    {
        $critique = rand(1, 4);
        $degats_crit = 0;

        if($critique > 1){
            $degats_crit = rand(4 , 8);
        }
        return $degats_crit;
    } 
}
