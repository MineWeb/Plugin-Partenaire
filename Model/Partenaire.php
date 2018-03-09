<?php

class Partenaire extends AppModel{



    public $useTable = "partenaire__partenaire";

    public function afterSave($created, $options=[]){

        if($created)

            $this->getEventManager()->dispatch(new CakeEvent('afterPartenaireSave', $this));

    }

}

