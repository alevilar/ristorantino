<?php

App::uses('RistoAppModel', 'Risto.Model');

class Config extends RistoAppModel {

    var $name = "Config";

    var $belongsTo = array('Risto.ConfigCategory');
}
?>