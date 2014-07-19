<?php
App::uses('AccountAppModel', 'Account.Model');

class Impuesto extends AccountAppModel {

	var $name = 'Impuesto';
        

	var $belongsTo = array(
		//'Account.Gasto',
                'Account.TipoImpuesto',
            );

}
?>