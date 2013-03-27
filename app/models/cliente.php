<?php

/* * ****
 * 
 * 
 * 
 * expresion regular para validar CUIT o CUIL
 * 			^[0-9]{2}-[0-9]{8}-[0-9]$
 * 
 */

class Cliente extends AppModel
{

    var $name = 'Cliente';
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
        'User' => array('className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Descuento' => array('className' => 'Descuento',
            'foreignKey' => 'descuento_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'IvaResponsabilidad',
        'TipoDocumento'
    );
    var $hasMany = array(
        'Mesa' => array('className' => 'Mesa',
            'foreignKey' => 'cliente_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    var $validate = array(
        'imprime_ticket' => array('boolean'),
        'nombre' => array(
            'nombre_no_vacio_si_es_factura_a' => array(
                'rule' => 'nombre_no_vacio_si_es_factura_a',
                'message' => 'El nombre no puede quedar vacio cuando se quiere hacer una factura "A".'
            )
        ),
        'nrodocumento' => array(
            'cuit_o_cuil_valido_si_tipodoc_es_cuit' => array(
                'rule' => 'cuit_o_cuil_valido_si_tipodoc_es_cuit',
                'required' => true,
                'allowEmpty' => true,
                'message' => 'El Nº de CUIT no es válido'
            ),
            'number' => array(
                'rule' => VALID_NUMBER,
                'allowEmpty' => true,
                'message' => 'Debe ingresar un valor numérico.'
            ),
        )
    );

    function nombre_no_vacio_si_es_factura_a()
    {
        if (!empty($this->data['Cliente']['iva_responsabilidad_id'])) {
            if ($this->data['Cliente']['iva_responsabilidad_id'] == 1 && empty($this->data['Cliente']['nombre'])) {
                return false;
            }
        }
        return true;
    }

    function cuit_o_cuil_valido_si_tipodoc_es_cuit()
    {
        if (!empty($this->data['Cliente']['nrodocumento'])) {
            if ($this->data['Cliente']['tipo_documento_id'] == 1) {
                $cuit = $this->data['Cliente']['nrodocumento'];
                return validate_cuit_cuil($cuit);
            }
        }
        return true;
    }

   

    /**
     * Me devuelve la responsabilidad del cliente frente el IVA
     * 
     * @return array find(first) con Cliente e IvaResponsabilidad
     */
    function getResponsabilidadIva($id = 0)
    {
        if ($id == 0) {
            $id = $this->id;
        }
        $ret = $this->find('first', array('conditions' => array('Cliente.id' => $id), 'contain' => array('IvaResponsabilidad')));
        return $ret;
    }

    /**
     * Me devuelve la responsabilidad del cliente frente el IVA
     * 
     * @return array find first con Cliente y TipoDocumento
     */
    function getTipoDocumento($id = 0)
    {
        if ($id == 0) {
            $id = $this->id;
        }
        $ret = $this->find('first', array('conditions' => array('Cliente.id' => $id), 'contain' => array('TipoDocumento')));
        return $ret;
    }

    function todos($type = 'all')
    {
        $clientes = $this->find($type, array(
            'order' => 'Cliente.nombre',
//                    'limit' => 10,
            'contain' => array(
                'Descuento'
            ),
                ));
        return $clientes;
    }

    function todosLosTipoA($type = 'all')
    {
        $clientes = $this->find($type, array(
            'order' => 'Cliente.nombre',
            'conditions' => array('Cliente.tipofactura' => 'A'),
                ));
        return $clientes;
    }

    function todosLosDeDescuentos($type = 'all', $limitarDescuento = false)
    {
        $conds = array('Cliente.descuento_id >' => 0);

        if ($limitarDescuento) {
            $conds['Descuento.porcentaje <='] = Config::read('Mozo.descuento_maximo');
        }

        $ops = array(
            'conditions' => $conds,
            'order' => 'Cliente.nombre',
            'contain' => array(
                'Descuento'
            ),
        );
        $clientes = $this->find($type, $ops);
        return $clientes;
    }

}

?>