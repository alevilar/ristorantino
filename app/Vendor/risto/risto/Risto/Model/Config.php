<?php

die("asas");


App::uses('RistoAppModel', 'Risto.Model');

class Config extends RistoAppModel {

    public $name = "Config";

    public $actsAs = array(
        'Containable',
        );


    public $belongsTo = array('Risto.ConfigCategory');
}
?>