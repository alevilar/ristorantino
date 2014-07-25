<?php


class Arqueo extends CashAppModel {

	public $name = 'Arqueo';
	public $validate = array(
		'caja_id' => array('numeric'),
                'datetime' => array(
                    'rule'    => array('datetime', 'ymd'),
                    'message' => 'La fecha y la hora no es un formato válido.'
                ),
                'importe_inicial' => array('numeric', 'notEmpty'),
                'importe_final' => array('numeric', 'notEmpty'),
	);
        
        public $order = array('Arqueo.datetime DESC');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
            'Cash.Caja', 
	);
        
        public $hasOne = array(
            'Cash.Zeta',
        );

        public function beforeSave($options = array())
        {
            parent::beforeSave($options);
            if (strlen( $this->data['Arqueo']['datetime'] ) == '16') {
                $this->data['Arqueo']['datetime'] = $this->data['Arqueo']['datetime'].':59';
            }
            return true;
        }
        
}
?>