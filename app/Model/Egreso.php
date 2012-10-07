<?php
class Egreso extends AppModel {

	var $name = 'Egreso';
        var $order = 'Egreso.created DESC';
	var $validate = array(
		'name' => array(
                    'notempty'=> array (
                        'rule'=>'notempty',
                        'message'=>'debe ingresar un valor',
                        )
                 ),
                'total' => array(
                    'notempty' => array(
                        'rule'=> array('notempty'),
                        'message'=> 'debe ingresar un valor',
                    ),
                    'numeric'=> array(
                        'rule' => 'numeric',
                        'message'=>'numero incorrecto',
                    )
                 )
	);

        var $belongsTo = array('TipoFactura','User');

        function buscarGastoConName($texto = '%', $type = 'list'){
            $this->order = 'Egreso.created DESC';
            $conditions = array('Egreso.name LIKE' => "%$texto%");
            return $this->find($type, array('conditions', $conditions));
        }

}
?>