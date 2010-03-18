<?php
class Gasto extends AppModel {

	var $name = 'Gasto';
        var $order = 'Gasto.created DESC';
	var $validate = array(
		'name' => array('notempty'),
                'importe' => array('notempty','numeric'),
	);


        function buscarGastoConName($texto = '%', $type = 'list'){
            $this->order = 'Gasto.created DESC';
            $conditions = array('Gasto.name LIKE' => "%$texto%");
            return $this->find($type, array('conditions', $conditions));
        }

}
?>