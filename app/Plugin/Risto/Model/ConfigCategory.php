<?php
App::uses('RistoAppModel', 'Risto.Model');

class ConfigCategory extends RistoAppModel {

    public $name = "ConfigCategory";

    public $hasMany = array('Risto.Config');
}
?>