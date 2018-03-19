<?php
abstract class Personnage {
    /*
     * Attributs
     */
    protected   $id,
                $nom,
                $degats,
                $type,
                $critique = 0;
    
    
    /*
     * Déclaration des constantes
     */
    const DETECT_ME     = 1; // Constante renvoyée par la méthode frapperUnPersonnage - détecte si on se frappe soi-même
    const PERSO_DEAD    = 2; // Constante renvoyée par la méthode frapperUnPersonnage - détecte si un personnage est tué en le frappant
    const PERSO_COUP    = 3; // Constante renvoyée par la méthode frapperUnPersonnage - détecte si un coup est bien porté à un personnage
    /*
     * Méthode de construction
     */
    public function __construct(array $datas) {
        $this->hydrate($datas);
        $this->type = strtolower(static::class);
    }
    
    
    /*
     * Methode d'hydratation
     */
    public function hydrate(array $datas) {
        foreach ($datas as $key => $value) {
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    
    
    /*
     * Méthodes génériques
     */
    // Methode de gestion de la frappe d'un personnage sur un autre
    public function frapperUnPersonnage(Personnage $persoAFrapper) {
        //echo $persoAFrapper->getId();
        //echo  ' VS ';
        //echo $this->id . '<br>';
        if ($persoAFrapper->getId() == $this->id) {
            return self::DETECT_ME;
        }
        // Indication au personnage qu'il reçoit un coup / des dégats
        // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_TUE ou self::PERSONNAGE_FRAPPE
        return $persoAFrapper->recevoirUnCoup($this);
    }
    
    // Methode de gestion de réception d'un coup, d'un dégat
    // Donne un coup avec 5 de degats
    public function recevoirUnCoup($from) {
        if($from->getType() == 'magicien'){
            $this->degats -= 3 * $this->critique_attack1();
            //echo $this->degats;
            //echo '<br>';
            //echo $this->critique_attack1();
        }
        elseif ($from->getType() == 'guerrier'){
            $this->degats -= 3 * $this->critique_attack1();
        }
       
        
        // 100 ou plus de dégats => le personnage est tué
        if ($this->degats <= 0) {
            return self::PERSO_DEAD;
        }
        
        // Le personnage reçoit un coup
        return self::PERSO_COUP;
    }



    public function frapperUnPersonnage2(Personnage $persoAFrapper) {
        echo $persoAFrapper->getId();
        echo  ' VS ';
        echo $this->id . '<br>';
        if ($persoAFrapper->getId() == $this->id) {
            return self::DETECT_ME;
        }
        // Indication au personnage qu'il reçoit un coup / des dégats
        // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_TUE ou self::PERSONNAGE_FRAPPE
        return $persoAFrapper->Attaque2($this);
        echo 'test';

    }

    public function Attaque2($from) {
        if($from->getType() == 'magicien'){
            echo $this->degats;
            $this->degats -= 5 * $this->critique_attack2();
            echo '<br>';
            echo $this->critique_attack2();
        }
        elseif ($from->getType() == 'guerrier'){
            $this->degats -= 5 * $this->critique_attack2();
        }
       
        
        // 100 ou plus de dégats => le personnage est tué
        if ($this->degats <= 0) {
            return self::PERSO_DEAD;
        }
        
        // Le personnage reçoit un coup
        return self::PERSO_COUP;
    }

    public function frapperUnPersonnage3(Personnage $persoAFrapper) {
        if ($persoAFrapper->getId() == $this->id) {
            return self::DETECT_ME;
        }
        // Indication au personnage qu'il reçoit un coup / des dégats
        // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_TUE ou self::PERSONNAGE_FRAPPE
        return $persoAFrapper->Attaque3($this);
    }

    public function Attaque3($from) {
        if($from->getType() == 'magicien'){
            $this->degats -= 2 + $this->critique_attack3();
           
        }
        elseif ($from->getType() == 'guerrier'){
            $this->degats -= 2 + $this->critique_attack3();
        }
       
        
        // 100 ou plus de dégats => le personnage est tué
        if ($this->degats <= 0) {
            return self::PERSO_DEAD;
        }
        
        // Le personnage reçoit un coup
        return self::PERSO_COUP;
    }
    
    
    /*
     * Méthodes Accesseurs (Getters) - Pour récupérer / lire la valeur d'un attribut
     */
    public function getId() {
        return $this->id;
    }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function getDegats() {
        return $this->degats;
    }
    
    public function getType() {
        return $this->type;
    }
    public function getCritique() {
        return $this->critique;
    }
    
    
    
     /*
      * Methodes Mutateurs (Setters) - Pour modifier la valeur d'un attribut
      * 
      * Pas de setter pour $_type car le type du personnage est constant - le magicien ne peut se tranfromer en guerrier
      * Le type est défini dans le constructeur
      */
     public function setId($id) {
         $this->id = (int)$id; // Pas de vérification - ID est obligatoirement un entier strictement positif
     }
     
     public function setNom($nom) {
         if (is_string($nom)) {     // Vérification si présence d'une chaîne de caractères
             $this->nom = $nom;    // On assigne alors la valeur $nom à l'attribut _nom
         }
     }
     
     public function setDegats($degats) {
         $degats = (int)$degats; // Conversion de l'argument en nombre entier
         // Vérification - Le nombre doit être strictemeznt positif et compris entre 0 et 100
         if ($degats >= 0 && $degats <= 1000) {
             $this->degats = $degats; // on assigne alors la valeur $degats à l'attribut _degats
         }
     }

     public function setCritique($critique) {
        $critique = (int)$critique; 
            $this->critique = $critique;
    }
     
}