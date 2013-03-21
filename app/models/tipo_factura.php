<?php
class TipoFactura extends AppModel {

	var $name = 'TipoFactura';
	var $validate = array(
		'name' => array('notempty')
	);
        var $order = 'TipoFactura.name';        

}
?>