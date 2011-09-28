<?php
class GastosTipoImpuesto extends AccountAppModel {

//	var $name = 'GastosTipoImpuesto';
        

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Account.Gasto',
		'TipoImpuesto'
	);

}
?>