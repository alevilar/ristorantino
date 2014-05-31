<?php

App::uses('ProductAppModel', 'Product.Model');

class HistoricoPrecio extends ProductAppModel{

    var $belongsTo = array('Producto');
}
?>
