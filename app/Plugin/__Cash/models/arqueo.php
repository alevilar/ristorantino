<?php


class Arqueo extends CashAppModel {

	var $name = 'Arqueo';
	var $validate = array(
		'caja_id' => array('numeric'),
                'datetime' => array(
                    'rule'    => array('datetime', 'ymd h:i'),
                    'message' => 'La fecha y la hora no es un formato válido.'
                ),
                'importe_inicial' => array('numeric', 'notEmpty'),
                'importe_final' => array('numeric', 'notEmpty'),
	);
        
        var $order = array('Arqueo.datetime DESC');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
            'Cash.Caja', 
	);
        
        var $hasOne = array(
            'Cash.Zeta',
        );

        public function beforeSave($options = array())
        {
            parent::beforeSave($options);
            if (strlen( $this->request->data['Arqueo']['datetime'] ) == '16') {
                $this->request->data['Arqueo']['datetime'] = $this->request->data['Arqueo']['datetime'].':59';
            }
            return true;
        }
        
}
?>