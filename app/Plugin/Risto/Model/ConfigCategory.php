<?php
App::uses('RistoAppModel', 'Risto.Model');

class ConfigCategory extends RistoAppModel {

    var $name = "ConfigCategory";

    var $hasMany = array('Risto.Config');
}
?>