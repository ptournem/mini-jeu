<?php

class Personnage {

    private $_id,
            $_degats,
            $_nom;

    const CEST_MOI = 1; // Constante renvoyée par la méthode `frapper` si on se frappe soi-même.
    const PERSONNAGE_TUE = 2; // Constante renvoyée par la méthode `frapper` si on a tué le personnage en le frappant.
    const PERSONNAGE_FRAPPE = 3; // Constante renvoyée par la méthode `frapper` si on a bien frappé le personnage.

    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    public function frapper(Personnage $perso) {
        //Le perso ne doit pas se frapper lui-même.
        if ($perso->id() == $this->_id) {
            return self::CEST_MOI;
        }

        //On indique au personnage frappé qu'il reçoit des dégats.
        // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_TUE ou self::PERSONNAGE_FRAPPE
        return $perso->recevoirDegats();
    }

    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function recevoirDegats() {
        //chaque coup fait augmenter de 5 points les dégats.
        $this->_degats += 5;
        //A 100 points de dégats ou plus, on indique au personnage qu'il est tué.
        if ($this->_degats >= 100) {
            return seflf::PERSONNAGE_TUE;
        }
        //Sinon qu'il a été frappé.
        return self::PERSONNAGE_FRAPPE;
    }

    //GETTERS 
    // Ceci est la méthode degats() : elle se charge de renvoyer le contenu de l'attribut $_degats.
    public function degats() {
        return $this->_degats;
    }

    // Ceci est la méthode id() : elle se charge de renvoyer le contenu de l'attribut $_id.
    public function id() {
        return $this->_id;
    }

    // Ceci est la méthode degats() : elle se charge de renvoyer le contenu de l'attribut $_nom.
    public function nom() {
        return $this->_nom;
    }

    //Mutateur chargé de modifier l'attibut $_degats.
    public function setDegats($degats) {
        $degats = (int) $degats;

        if ($degats >= 0 && $degats <= 100) {
            $this->_degats = $degats;
        }
    }

    public function setId($id) {
        $id = (int) $id;

        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setNom($nom) {
        if (is_string($nom)) {
            $this->_nom = $nom;
        }
    }

    public function nomValide() {
        return !empty($this->_nom);
    }

}
