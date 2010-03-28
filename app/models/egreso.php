<?php
class Egreso extends AppModel {

	var $name = 'Egreso';
        var $order = 'Egreso.created DESC';
	var $validate = array(
		'name' => array('notempty'),
                'total' => array('notempty','numeric'),
	);

        var $belongsTo = array('TipoFactura');

        function buscarGastoConName($texto = '%', $type = 'list'){
            $this->order = 'Egreso.created DESC';
            $conditions = array('Egreso.name LIKE' => "%$texto%");
            return $this->find($type, array('conditions', $conditions));
        }

}
?>