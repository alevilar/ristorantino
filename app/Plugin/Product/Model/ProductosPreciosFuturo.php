<?php
App::uses('ProductAppModel', 'Product.Model');

class ProductosPreciosFuturo extends ProductAppModel{
    public $belongsTo = array('Product.Producto');

    public $primaryKey = 'producto_id';

    public $validate = array(
	'producto_id' => array(
		'isUnique',
		)
	);
}
?>
