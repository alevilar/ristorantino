<?php
App::uses('ProductAppModel', 'Product.Model');

class ProductosPreciosFuturo extends ProductAppModel{
    var $belongsTo = array('Product.Producto');

    var $primaryKey = 'producto_id';

    var $validate = array(
	'producto_id' => array(
		'isUnique',
		)
	);
}
?>
