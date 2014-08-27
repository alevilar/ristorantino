<?php


class Zeta extends CashAppModel {

	public $name = 'Zeta';
	public $validate = array(
                'numero_comprobante' => array('numeric'),
                'total_ventas' => array('numeric'),
	);
        
        public $order = array('Zeta.numero_comprobante DESC');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
            'Cash.Arqueo'
	);

        
        function beforeSave($options = array())
        {
            if (empty($this->data['Zeta']['total_ventas'])){
                $this->data['Zeta']['total_ventas'] = 0;
            }
            if (empty($this->data['Zeta']['monto_iva'])){
                $this->data['Zeta']['monto_iva'] = 0;
            }
            if (empty($this->data['Zeta']['nota_credito_iva'])){
                $this->data['Zeta']['nota_credito_iva'] = 0;
            }
            if (empty($this->data['Zeta']['monto_neto'])){
                $this->data['Zeta']['monto_neto'] = 0;
            }
            if (empty($this->data['Zeta']['nota_credito_neto'])){
                $this->data['Zeta']['nota_credito_neto'] = 0;
            }
            return parent::beforeSave($options);
        }
        
        function delDia($desde, $hasta = null){
             $horarioCorte = Configure::read('Horario.corte_del_dia');
            if ( $horarioCorte < 10 ) {
                $horarioCorte = "0$horarioCorte";
            }
            
            if (empty($hasta)){
                $hasta = $desde;
                
            }
            $zetas = $this->find('all', array(
              'fields'  => array(
                  "DATE(SUBTIME(Zeta.created, '$horarioCorte:00:00')) as fecha",                  
                  'sum(Zeta.total_ventas) as ventas',
                  '(sum(Zeta.monto_iva)- sum(Zeta.nota_credito_iva)) as iva',
                  '(sum(Zeta.monto_neto)-sum(Zeta.nota_credito_neto)) as neto',
              ),
              'conditions' => array(
                  "DATE(SUBTIME(Zeta.created, '$horarioCorte:00:00')) BETWEEN ? AND ?" => array($desde, $hasta)
              ),
              'group' => array('fecha'),
               'order' => array('fecha DESC'),
            ));
            return $zetas;
        }
}
?>