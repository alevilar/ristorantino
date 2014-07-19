<?php


class Zeta extends CashAppModel {

	var $name = 'Zeta';
	var $validate = array(
                'numero_comprobante' => array('numeric'),
                'total_ventas' => array('numeric'),
	);
        
        var $order = array('Zeta.numero_comprobante DESC');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
            'Cash.Arqueo'
	);

        
        function beforeSave($options = array())
        {
            if (empty($this->request->data['Zeta']['total_ventas'])){
                $this->request->data['Zeta']['total_ventas'] = 0;
            }
            if (empty($this->request->data['Zeta']['monto_iva'])){
                $this->request->data['Zeta']['monto_iva'] = 0;
            }
            if (empty($this->request->data['Zeta']['nota_credito_iva'])){
                $this->request->data['Zeta']['nota_credito_iva'] = 0;
            }
            if (empty($this->request->data['Zeta']['monto_neto'])){
                $this->request->data['Zeta']['monto_neto'] = 0;
            }
            if (empty($this->request->data['Zeta']['nota_credito_neto'])){
                $this->request->data['Zeta']['nota_credito_neto'] = 0;
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