<?php

class ProductosPreciosFuturo extends AppModel{
    var $belongsTo = array('Producto');

    var $primaryKey = 'producto_id';

    var $validate = array(
	'producto_id' => array(
		'isUnique',
		)
	);
}
?>
