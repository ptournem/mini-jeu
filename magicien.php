<?php

class Magicien extends Personnage {

    public function lancerUnSort(Personnage $perso) {
        if ($this->_degats >= 0 && $this->_degats <= 25) {
            $this->_atout = 4;
        } elseif ($this->_degats > 25 && $this->_degats <= 50) {
            $this->atout = 3;
        } elseif ($this->_degats > 50 && $this->_degats <= 75) {
            $this->atout = 2;
        } elseif ($this->_degats > 75 && $this->_degats <= 90) {
            $this->_atout = 1;
        } else {
            $this->_atout = 0;
        }

        if ($perso->_id == $this->_id) {
            return self::CEST_MOI;
        }

        if ($this->_atout == 0) {
            return self::PAS_DE_MAGIE;
        }

        if ($this->estEndormi()) {
            return self::PERSO_ENDORMI;
        }

        $perso->_timeEndormi = time() + ($this->_atout * 6) * 3600;

        return self::PERSONNAGE_ENSORCELE;
    }

}
