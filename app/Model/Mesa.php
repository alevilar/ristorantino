<?php

App::uses('AppModel', 'Model');

/**
 * Mesa Model
 *
 * @property Mozo $Mozo
 * @property Cliente $Cliente
 * @property Estado $Estado
 * @property Descuento $Descuento
 * @property Comanda $Comanda
 * @property Pago $Pago
 */
class Mesa extends AppModel
{

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'numero';

    /**
     * Behaiviours
     * @var array 
     */
    public $actsAs = array(
        'Containable',
        'SoftDeletable',
        'Search.Searchable',
    );
    
    
    
    public $numero = 0;
    
    
    public $mozoNumero = 0;
    
    
    
    /**
 * Searchable Plugin
 * @var array 
 */    
    public $filterArgs = array(
        'numero' => array('type' => 'value'),
        'mozo_id' => array('type' => 'value'),
        'mozo_numero' => array('type' => 'value', 'field' => 'Mozo.numero'),
        'total' => array('type' => 'value'),
        'estado_id' => array('type' => 'value'),
        'created_desde' => array('type' => 'value', 'field' => 'date(Mesa.created) >='),
        'created_hasta' => array('type' => 'value', 'field' => 'date(Mesa.created) <='),
        'time_cerro_desde' => array('type' => 'value', 'field' => 'date(Mesa.time_cerro) >='),
        'time_cerro_hasta' => array('type' => 'value', 'field' => 'date(Mesa.time_cerro) <='),
        'time_cobro_desde' => array('type' => 'value', 'field' => 'date(Mesa.time_cobro) >='),
        'time_cobro_hasta' => array('type' => 'value', 'field' => 'date(Mesa.time_cobro) <='),
    );
    
    
     /*
     * Valor total de una mesa Objeto en particular.
     * Es el array que devuelve la funcion getTotal()
     * @public $total float
     */
    public $total = array();
    

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'numero' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'mozo_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'menu' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'cant_comensales' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'estado_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'deleted' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Mozo',
        'Cliente',
        'Descuento',
        'Estado',
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Comanda' => array(
            'className' => 'Comanda',
            'foreignKey' => 'mesa_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Pago' => array(
            'className' => 'Pago',
            'foreignKey' => 'mesa_id',
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
    
    
    
    public $order = array('Mesa.created' => 'desc');
    
    
    
    public function save($data = null, $validate = true, $fieldList = array())
    {
        // Clear modified field value before each save
        $this->set($data);
        if (isset($this->data[$this->alias]['modified'])) {
            unset($this->data[$this->alias]['modified']);
        }
        return parent::save($this->data, $validate, $fieldList);
    }

    function getMozoNumero($id = null)
    {
        if (!empty($id)) {
            $this->id = $id;
        }
        
        if (!empty($this->data['Mozo']['numero'])) {
            $this->mozoNumero = $this->data['Mozo']['numero'];
        }
        
        if (empty($this->mozoNumero)) {
            $mozo = $this->find('first', array(
                'conditions' => array('Mesa.id' => $this->id),
                'contain' => array('Mozo')
                    ));
            $this->mozoNumero = $mozo['Mozo']['numero'];
        }

        return $this->mozoNumero;
    }

    function cerrar_mesa($mesa_id = 0)
    {
        $this->id = ($mesa_id == 0) ? $this->id : $mesa_id;
        if (empty($this->id)) {
            throw new InternalErrorException("No se puede cerrar una mesa con el ID vacio");
             return false;
        }
        
        if ( !$this->hasAny() ) return false;
        $nowtime = date("Y-m-d H:i:s", strtotime('now'));
        $mesaData['Mesa'] = array(
            'id' => $this->id,
            'estado_id'  => MESA_CERRADA,
            'total'      => $this->getTotal(),
            'subtotal'   => $this->getSubtotal(),
            'time_cerro' => $nowtime,
        );

        // si no estoy usando cajero, entonces poner como que ya esta cerrada y cobrada
        if (!Configure::read('Adicion.usarCajero')) {
            $mesaData['Mesa']['time_cobro'] = $nowtime;
            $mesaData['Mesa']['estado_id'] = MESA_COBRADA;
        }

        if ($this->save($mesaData, false)) {
            return $mesaData;
        } else {
            throw new Exception("no se pudo guardar la mesa");
            return false;
        }
        
    }

    function calcular_total_productos($id = null)
    {
        if (!empty($id))
            $this->id = $id;

        $total = $this->query("
                select sumadas.mesa_id as mesa_id,sum(total) as subtotal, cant_comensales
                from (
                        select c.mesa_id as mesa_id, sum(s.precio*(dc.cant-dc.cant_eliminada)) as total
                        from comandas c
                        left join detalle_comandas dc on (dc.comanda_id =  c.id)
                        left join detalle_sabores ds on (ds.detalle_comanda_id =  dc.id)
                        left join sabores s on (s.id = ds.sabor_id)
                        where 
                        c.mesa_id = $this->id AND
                        (dc.cant-dc.cant_eliminada) > 0
                        group by mesa_id
                UNION ALL
                select c.mesa_id as mesa_id, sum(p.precio*(dc.cant-dc.cant_eliminada)) as total
                        from comandas c
                        left join detalle_comandas dc on (dc.comanda_id = c.id)
                        left join productos p on (dc.producto_id = p.id)
                        where 
                        c.mesa_id = $this->id AND
                        (dc.cant-dc.cant_eliminada) > 0
                        group by mesa_id
                ) as sumadas

                LEFT JOIN

                        (select id as mesa_id, cant_comensales
                                from mesas
                                where 
                                id = $this->id
                        ) as dd on (dd.mesa_id = sumadas.mesa_id)
                        group by sumadas.mesa_id			

                ");
        return $total[0][0]['subtotal'];
    }

    function calcular_descuentos($id = null)
    {
        if (!empty($id))
            $this->id = $id;

        $total = $this->query("
                select m.mesa_id, IF(ISNULL(desc.porcentaje), 0 , desc.porcentaje) as descuento, IF(ISNULL(clidesc.porcentaje), 0 , clidesc.porcentaje) as descuentocli
		FROM detalle_comandas dc
		LEFT JOIN comandas c on (dc.comanda_id = c.id)
		LEFT JOIN mesas m on (c.mesa_id = ..id)
		LEFT JOIN clientes cli on (cli.id = m.cliente_id )                
		LEFT JOIN descuentos clidesc on (cli.descuento_id = clidesc.id)
                LEFT JOIN descuentos desc on (desc.id = m.descuento_id)
		WHERE 
		dc.mesa_id = $this->id
		GROUP BY dc.mesa_id        
            ");
        $descuentoTotal = $total[0][0]['descuento']+$total[0][0]['descuentocli'];
        
        return $descuentoTotal;
    }

    
    public function calcular_totales($id = null) {
        if (!empty($id)) {
            $this->id = $id;
        }
        
        $this->total['Mesa']['subtotal'] = 0;
        $this->total['Mesa']['total'] = 0;
        $this->total['Mesa']['descuento'] = 0;
        $this->total['Mesa']['importe_descuento'] = 0;
                
        if ( !$this->Comanda->DetalleComanda->tieneProductosLaMesa( $this->id ) ) {
            return $this->total;
        }

        $totalProductos = $this->calcular_total_productos();
        $totalPorcentajeDescuento = $this->calcular_descuentos();
        $conversionDescuento = 1 - ($totalPorcentajeDescuento / 100);

        $this->recursive = -1;
        $mesa = $this->read();
        $this->total['Mesa']['cant_comensales'] = $mesa['Mesa']['cant_comensales'];

        $precioCubierto = Configure::read('Restaurante.valorCubierto');
        $valor_cubierto = 0;
        if ($precioCubierto > 0) {
            $valor_cubierto = $precioCubierto * $this->total['Mesa']['cant_comensales'];
        }
        $this->total['Mesa']['subtotal'] = $totalProductos + $valor_cubierto;
        $this->total['Mesa']['total'] = cqs_round($this->total['Mesa']['subtotal'] * $conversionDescuento);
        $this->total['Mesa']['descuento'] = $totalPorcentajeDescuento;
        $this->total['Mesa']['importe_descuento'] = $this->total['Mesa']['subtotal'] - $this->total['Mesa']['total'];
        
        return $this->total;
    }
    
    function getImporteDescuento($id = null)
    {
        if (empty($id)) {
            $id = $this->id;
        }
        
        if (empty($this->total)) {
            $this->calcular_totales($id);
        }
        
        return $this->total['Mesa']['importe_descuento'];
    }
    
    function getPorcentaeDescuento($id = null)
    {
        if (empty($id)) {
            $id = $this->id;
        }
        
        if (empty($this->total)) {
            $this->calcular_totales($id);
        }
        
        return $this->total['Mesa']['descuento'];
    }
    
    function getSubtotal($id = null)
    {
        if (empty($id)) {
            $id = $this->id;
        }
        
        if (empty($this->total)) {
            $this->calcular_totales($id);
        }
        
        return $this->total['Mesa']['subtotal'];
    }

    /**
     * Calcula el total de la mesa cuyo id fue seteado en $this->Mesa->id 
     * return @total el valor
     */
    function getTotal($id = null)
    {
        if (empty($id)) {
            $id = $this->id;
        }
        
        if (empty($this->total)) {
            $this->calcular_totales($id);
        }

        return $this->total['Mesa']['total'];
    }


    function ultimasCobradas($limit = 20)
    {

        $conditions = array("Mesa.estado_id >=" => MESA_COBRADA);

        $mesas = $this->find('all', array(
            'conditions' => $conditions,
            'limit' => $limit,
            'order' => 'Mesa.time_cobro DESC',
                ));

        return $mesas;
    }

    function listado_de_abiertas($recursive = -1)
    {

        $conditions = array("Mesa.estado_id" => MESA_ABIERTA);

        if ($recursive > -1) {
            $this->recursive = $recursive;
            $mesas = $this->find('all', array('conditions' => $conditions));
        } else {
            $mesas = $this->find('all', array(
                'conditions' => $conditions,
                'contain' => array('Mozo(numero)')
                    ));
        }
        return $mesas;
    }

    function listadoAbiertasYSinCobrar($recursive = -1)
    {

        $conditions = array("Mesa.estado_id <" => MESA_COBRADA);

        if ($recursive > -1) {
            $this->recursive = $recursive;
            $mesas = $this->find('all', array(
                'conditions' => $conditions));
        } else {
            $mesas = $this->find('all', array(
                'conditions' => $conditions,
                'contain' => array('Mozo(numero, id)')));
        }

        //debug($mesas);
        return $mesas;
    }

    /**
     * nos dice si el numero de mesa existe o no
     * 
     * @param integer numero demesa
     * @return boolean
     */
    function numero_de_mesa_existente($numero_mesa = 0)
    {
        if ($numero_mesa == 0) {
            if (!empty($this->data['Mesa']['numero'])) {
                $numero_mesa = $this->data['Mesa']['numero'];
            }
        }

        $this->recursive = -1;
        $conditions = array(
            'estado_id' => MESA_ABIERTA,
            'numero' => $numero_mesa);

        if (!empty($this->id)) {
            if ($this->id != '') {
                $conditions = array_merge($conditions, array('Mesa.id <>' => $this->id));
            }
        }

        $result = $this->find('count', array('conditions' => $conditions));

        return ($result > 0) ? true : false;
    }

    function getNumero($mesa_id = 0)
    {
        if ($mesa_id != 0) {
            $this->id = $mesa_id;
        }
        $mesa = $this->read();
        return $mesa['Mesa']['numero'];
    }

    /**
     *
     * Esta funcion sirve para los casos en que no se quiere mostrar
     * el detalle de los productos consumidos en el ticket.
     * En ese caso sale impresa la leyenda "X MENU". La cantidad de menues
     * (en este caso "X") viene dado por el parametro $cantMenues.
     * El total de la mesa hay que pasarlo para luego dividirlo por la cantMenues
     *
     * @param integer $cantMenues cantidad, por ejemplo
     * @param float $total
     */
    function getProductosSinDescripcion($cantMenues, $descripcion = 'Menu')
    {
        if ($descripcion == 'Menu' && ($descAux = Configure::read('Mesa.descripcionSinProductos'))) {
            $descripcion = $descAux;
        }
        $prod[0]['nombre'] = $descripcion;
        $total = $this->getSubtotal();
        $prod[0]['precio'] = number_format($total / $cantMenues, 2);
        $prod[0]['cantidad'] = $cantMenues;
        return $prod;
    }

    function dameProductosParaTicket($id = 0)
    {
        if ($id != 0)
            $this->id = $id;


        $items = $this->query("
                    select sum(cant-cant_eliminada) as cant, name as 'name', precio as precio from (
                        select
                        dc.cant,
                        dc.cant_eliminada,
                        p.abrev as name,
                        p.precio +  IFNULL((
                                select IFNULL(sum(s.precio),0) from detalle_sabores ds
                                left join sabores s on s.id = ds.sabor_id
                                where ds.detalle_comanda_id = dc.id
                                group by ds.detalle_comanda_id
                        ),0) precio,
                        dc.id,
                        p.order as orden
                        from
                        comandas c
                        left join detalle_comandas dc on dc.comanda_id = c.id
                        left join detalle_sabores ds on ds.detalle_comanda_id = dc.id
                        left join productos p on p.id = dc.producto_id
                        where c.mesa_id = $this->id
                        group by dc.id
                ) as DetalleComanda
                group by name, precio
                having cant > 0
                order by orden
                ");

        $vItems = array();
        $cont = 0;
        foreach ($items as &$i) {
            $vItems[$cont]['nombre'] = $i['DetalleComanda']['name'];
            $vItems[$cont]['cantidad'] = $i[0]['cant'];
            $vItems[$cont]['precio'] = cqs_round($i['DetalleComanda']['precio'], 2);
            $cont++;
        }

        return $vItems;
    }

    /**
     * devuelve todaslasmesas cerradas orcdenadas por fecha de cierre ASC
     * @return array mesas find(all)
     */
    function todasLasCerradas()
    {
        $this->recursive = 0;
        $conditions = array('estado_id' => MESA_CERRADA);
        return $this->find('all', array('conditions' => $conditions, 'order' => 'time_cerro'));
    }

    /**
     * Dice si una mesa esta cerrada o no
     * @param integer $id
     * @return boolean
     */
    function estaCerrada($id = null)
    {
        if (!empty($id)) {
            $this->id = $id;
        }
        // si lo tengo en memoria primero busco por aca
        if (!empty($this->data[$this->name]['estado_id'])) {
            return $this->data[$this->name]['estado_id'] == MESA_CERRADA;
        }
        // lo busco en BBDD        
        $ret = $this->find('count', array(
            'conditions' => array(
                'Mesa.estado_id' => MESA_CERRADA,
                'Mesa.id' => $this->id,
            )
                ));

        if ($ret > 0)
            return false;
        else
            return true;
    }
    
    
    /**
     * Dice si una mesa esta abierta y nunca fue cerrada ni cobrada
     * o sea, que nunca fue re-abierta.     
     * 
     * @param integer $id
     * @return boolean
     */
    function estaAbiertaPeroNoEsReabierta($id = null)
    {
        if (!empty($id)) {
            $this->id = $id;
        }
        // si lo tengo en memoria primero busco por aca
        if (!empty($this->data[$this->name]['estado_id'])) {
            return $this->data[$this->name]['estado_id'] == MESA_ABIERTA;
        }
        // lo busco en BBDD        
        $ret = $this->find('count', array(
            'conditions' => array(
                'Mesa.estado_id' => MESA_ABIERTA,
                'Mesa.id' => $this->id,
                'Mesa.time_cerro' => '0000-00-00 00:00:00',
                'Mesa.time_cobro' => '0000-00-00 00:00:00',
            )
                ));

        return ($ret > 0);
    }

    /**
     * Dice si una mesa esta abierta o no
     * @param integer $id
     * @return boolean
     */
    function estaAbierta($id = null)
    {
        if (!empty($id)) {
            $this->id = $id;
        }
        // si lo tengo en memoria primero busco por aca
        if (!empty($this->data[$this->name]['estado_id'])) {
            return $this->data[$this->name]['estado_id'] == MESA_ABIERTA;
        }
        // lo busco en BBDD        
        $ret = $this->find('count', array(
            'conditions' => array(
                'Mesa.estado_id' => MESA_ABIERTA,
                'Mesa.id' => $this->id,
            )
                ));

        return ($ret > 0);
    }

    
/**
 * Elimina los pagos que tiene esa mesa asociada (si es que los tiene)
 * Pone el estado de la mesa en "Abierta"
 * 
 * @param type $mesa_id
 * @return boolean true if success
 */    
    function reabrir($mesa_id = null)
    {
        if (!empty($mesa_id)) {
            $this->id = $mesa_id;
        }
        
        if (empty($this->id)){
            return false;
        }
        
        // eliminar todos los pagos
        if ( !$this->Pago->deleteAll(array(
            'mesa_id' => $this->id
                ), $cascada = false)) {
            return false;
        }
        
        if (!$this->saveField('estado_id', MESA_ABIERTA)){
            return false;
        }
        return true;
    }

    /**
     * Me devuelve un listado agrupado por dia de mesas. Util para estadistica y contabilidad
     * @param type $fechaDesde string formato de fecha debe ser del tip AÑO-mes-dia Y-m-d
     * @param type $fechaHasta string formato de fecha debe ser del tip AÑO-mes-dia Y-m-d
     * @param type $conds array de condiciones extra
     */
    function totalesDeMesasEntre($fechaDesde = '', $fechaHasta = '', $conds = array())
    {
        $horarioCorte = Configure::read('Horario.corte_del_dia');
        $limit = empty($conds['limit']) ? '' : $conds['limit'];
        $desde = empty($fechaDesde) ? date('Y-m-d', strtotime('now')) : $fechaDesde;
        $hasta = empty($fechaHasta) ? date('Y-m-d', strtotime('now')) : $fechaHasta;

        $fieldConds = empty($conds['fields']) ? array() : $conds['fields'];
        $fields = array_merge(array('count(*) as "cant_mesas"'), $fieldConds);

        $groups = empty($conds['fields']) ? array() : $conds['group'];

        $fieldsText = '';
        $i = 0;
        foreach ($fields as $f) {
            if ($i > 0) {
                $fieldsText .= ', ';
            }
            $fieldsText .= $f;
            $i++;
        }

        $groupByText = '';
        if (!empty($groups)) {
            $groupByText = 'GROUP BY ';
            $i = 0;
            foreach ($groups as $g) {
                if ($i > 0) {
                    $groupByText .= ', ';
                }
                $groupByText .= $g;
                $i++;
            }
        }

        $orderByText = 'ORDER BY m.created DESC ';
        $order = empty($conds['order']) ? array() : $conds['order'];
        if (!empty($order)) {
            $orderByText = 'ORDER BY ';
            $i = 0;
            foreach ($order as $o) {
                if ($i > 0) {
                    $orderByText .= ', ';
                }
                $orderByText .= $o;
                $i++;
            }
        }

        $query = '    SELECT 
                    ' . $fieldsText . '
FROM (
    SELECT m.id, m.numero, m.mozo_id, m.total,m.subtotal, m.cant_comensales, 
    m.cliente_id, m.menu, ADDDATE(m.created,-1) as created, m.modified, m.time_cerro, m.time_cobro 
    FROM mesas m
    WHERE m.deleted = 0 AND DATE(m.created) BETWEEN DATE(ADDDATE("' . $desde . '",+1)) AND DATE(ADDDATE("' . $hasta . '",+1)) 
          AND HOUR(m.created) BETWEEN 0 AND ' . $horarioCorte . '
UNION
    SELECT id,numero,mozo_id,total, m.total, cant_comensales, cliente_id,menu, created, modified, time_cerro, time_cobro 
    FROM mesas m
    WHERE m.deleted = 0 AND DATE(m.created) BETWEEN "' . $desde . '" AND "' . $hasta . '" AND HOUR(m.created) BETWEEN ' . $horarioCorte . ' AND 24) as m    
              
LEFT JOIN mozos z ON z.id = m.mozo_id              
' . $groupByText . '
' . $orderByText . '    
' . $limit;
        return $this->query($query);
    }


    
/**
 * Trae todos los datos necesarios para que se pueda imprimir un ticket 
 * 
 * @param integer $mesa_id 
 * @return array
 */    
    public function getDataParaFiscal($mesa_id = null) {
        // el array que serpa devuelto
        $mesaData = array();
        
        if (empty($mesa_id)) {
            $mesa_id = $this->id;
        }
        
        $mesa = $this->find('first',array(
            'contain'=>array(
                'Mozo',
                'Descuento',
                'Cliente'=>array(
                    'Descuento',
                    'IvaResponsabilidad.TipoFactura',
                    'TipoDocumento',
                    )
                ),
            'condition' => array(
                'Mesa.id' => $mesa_id
            )
        ));
        
        $prod = array();
        if ( $mesa['Mesa']['menu'] > 0 ) {
            $prod = $this->getProductosSinDescripcion($mesa['Mesa']['menu']);
        } else {
            $prod = $this->dameProductosParaTicket();
        }
        $mesa['Items'] = $prod;
        
        $mesa['Mesa']['mozo_numero'] = $mesa['Mozo']['numero'];
        
        if ( !empty($mesa['Cliente']['IvaResponsabilidad']['TipoFactura']) ) {
            $mesa['Mesa']['tipo_factura'] = $mesa['Cliente']['IvaResponsabilidad']['TipoFactura']['codename'];
        }
        
        $totales = $this->calcular_totales();
        $mesa['Totales'] = $totales['Mesa'];
        
        return $mesa;
        
    }
    
    
     /**
         * Para todos los mozos activos, me trae sus mesas abiertas
         * @param int $mozo_id id del mozo, en caso de que no le pase ninguno, me busca todos
         * @return array Mozos con sus mesas, Comandas, detalleComanda, productos y sabores
         */
        public function getAbiertas($mozo_id = null, $lastAccess = null){
            $conditions = array();
            
            // si vino el mozo por parametro, es porque solo quiero las mesas de ese mozo
            if ( !empty($mozo_id) ){
               $conditions['Mozo.id'] =  $mozo_id;
            } else {
                // todos los mozos activos
                $conditions['Mozo.activo'] =  1;
            }
            
            // condiciones para traer mesas abiertas y pendientes de cobro
            $conditions = array(
                "Mesa.estado_id <" => MESA_COBRADA,
                'Mesa.deleted' => 0,        
            );
            
            // si vino el parametro lastAccess, traer solo las mesas actualizadas luego del ultimo pedido
            if ( !empty($lastAccess) ) {
                $conditions['Mesa.modified >='] = $lastAccess;
            }
            
            $optionsEliminada = $optionsCobrada = $optionsUpdated = $optionsCreated = array(
                'contain' => array(
                    'Mozo',
                    'Cliente' => 'Descuento',
                    'Descuento',
                    'Estado',
                    'Comanda' => array(
                        'DetalleComanda' => array(
                            'Producto',
                            'DetalleSabor.Sabor'),
                    ),
                ),
                'order' => 'Mesa.created asc',
                'conditions'=> $conditions,
            );
            
            if ( !empty($lastAccess) ) {
                // las que fueron creadas
                $optionsCreated['contain']['Mesa']['conditions']['created >='] = $lastAccess;
                $mesasABM['created'] = $this->find('all', $optionsCreated);

                // las que fueron actualizadas
                
                $optionsUpdated['contain']['Mesa']['conditions']['created <'] = $lastAccess;
                $mesasABM['modified'] = $this->find('all', $optionsUpdated);
                
                // las que fueron cobradas
                unset( $optionsCobrada['contain']['Mesa']['conditions']["Mesa.estado_id <"] );
                $optionsCobrada['contain']['Mesa']['conditions']['Mesa.estado_id'] = MESA_COBRADA;
                $mesasABM['cobradas'] = $this->find('all', $optionsCobrada);
                
                // las que fueron borradas o eliminadas
                $optionsEliminada['contain']['Mesa']['conditions']['Mesa.deleted_date >'] = $lastAccess;
                $optionsEliminada['contain']['Mesa']['conditions']['Mesa.deleted'] = 1;
                $mesasABM['deleted'] = $this->find('all', $optionsEliminada);
            } else {
                // traigo a todas como que son creadas, si no fue pasado un lastAccess
                $mesasABM = $this->find('all', $optionsCreated);
            }
            
            foreach ($mesasABM as &$m) {
                $tot = $this->calcular_totales($m['Mesa']['id']);
                foreach($tot['Mesa'] as $k=>$v)
                $m['Mesa'][$k] = $v;
            }

            return $mesasABM;
        }
        
    

}
