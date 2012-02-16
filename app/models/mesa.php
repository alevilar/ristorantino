<?php



class Mesa extends AppModel {

	var $name = 'Mesa';
	var $actsAs = array('Containable', 'SoftDeletable');

        var $numero = 0;
        var $mozoNumero = 0;
	
	var $validate = array(
                'mozo_id' => array(
			'notempty',
			'numeric',
                    ),
		'numero' => array(
			'notempty',
			'numeric',	
	));
        
        

        /*
         * Valor total de una mesa Objeto en particular.
         * Es el array que devuelve la funcion calcular_total()
         * @var $total float
         */
        var $total = array();
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Mozo',
			'Cliente',
                        'Descuento',
	);


	var $hasMany = array(   'Comanda' => array(
                                    'order' => 'Comanda.created DESC'), 
                                'Pago');
	

        
        
        function beforeSave($options = array()) {
           $this->data[$this->name]['modified'] = date('Y-m-d H:i:s', strtotime('now'));
           
           return parent::beforeSave($options);
       }


        function getMozoNumero($id = null){
            if (!empty($id)) {
                $this->id = $id;
            }
            if(empty($this->mozoNumero)){
                $mozo = $this->find('first', array(
                    'conditions' => array('Mesa.id'=>$this->id),
                    'contain' => array('Mozo')
                    ));
                $this->mozoNumero = $mozo['Mozo']['numero'];
            }

            return $this->mozoNumero;
        }
	
	
	function cerrar_mesa($mesa_id = 0)
	{
		$this->id = ($mesa_id == 0)?$this->id:$mesa_id;
                $cant = $this->find('count',array('conditions'=>array(
                    'Mesa.id' => $this->id,
                )));
                if ($cant == 0) return 0;

                $mesaData['Mesa'] = array(
                    'estado_id'    => MESA_CERRADA,
                    'total'     => $this->calcular_total(),
                    'subtotal'  => $this->calcular_subtotal(),
                    'time_cerro'=> date( "Y-m-d H:i:s",strtotime('now')),
                );
                debug($mesaData);

                // si no estoy usando cajero, entonces poner como que ya esta cerrada y cobrada
                if (!Configure::read('Adicion.usarCajero'))  {
                    $mesaData['Mesa']['time_cobro'] = date( "Y-m-d H:i:s",strtotime('now'));
                    $mesaData['Mesa']['estado_id']  = MESA_COBRADA;
                } else {
                    $mesaData['Mesa']['time_cobro'] = DATETIME_NULL;
                }

                $this->save($mesaData, false);
                return $mesaData;
		
	}


        
        function calcular_total_productos ($id = null) {
            if (!empty($id)) $this->id = $id;
            
            $total =  $this->query("
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
        
        
        function calcular_descuentos($id = null) {
            if (!empty($id)) $this->id = $id;
            
            $total =  $this->query("
                select mesa_id, IF(ISNULL(descuentos.porcentaje), 0 , descuentos.porcentaje) as descuento
		from detalle_comandas
		left join comandas on (comanda_id = comandas.id)
		left join mesas on (mesa_id = mesas.id)
		left join clientes on (clientes.id = mesas.cliente_id )
		left join descuentos on (clientes.descuento_id = descuentos.id)
		where 
		mesa_id = $this->id
		group by mesa_id        
            ");
            return $total[0][0]['descuento'];
            
        }
        
        
        
        function calcular_subtotal($id = null){
            if (!empty($id)) $this->id = $id;

            if (!empty($this->total)) {
                return $this->total['Mesa']['subtotal'];
            }
            
            if ($this->cantidadDeProductos() == 0) return 0;
            

            $totalProductos = $this->calcular_total_productos();
            $totalPorcentajeDescuento = $this->calcular_descuentos();
            $conversionDescuento = 1-($totalPorcentajeDescuento/100);
            
            $this->recursive = -1;
            $mesa = $this->read();
            $this->total['Mesa']['cant_comensales'] = $mesa['Mesa']['cant_comensales'];
                        
            $precioCubierto = Configure::read('Restaurante.valorCubierto');
            $valor_cubierto = 0;
            if ($precioCubierto > 0) {
                $valor_cubierto =  $precioCubierto * $this->total['Mesa']['cant_comensales'];
            }
            $this->total['Mesa']['subtotal'] = $totalProductos + $valor_cubierto;
            $this->total['Mesa']['total'] = cqs_round(  $this->total['Mesa']['subtotal'] * $conversionDescuento );
            $this->total['Mesa']['descuento'] = $totalPorcentajeDescuento;
            return $this->total['Mesa']['subtotal'];
        }
            

	
	/**
	 * Calcula el total de la mesa cuyo id fue seteado en $this->Mesa->id 
	 * return @total el valor
	 */
	function calcular_total($id = null){
            if (!empty($id)) $this->id = $id;

            if ( empty($this->total['Mesa']['total']) ) {
                $this->calcular_subtotal();
            }
            return $this->total['Mesa']['total'];
	}
	
	
	function cantidadDeProductos($id = 0){
            if($id != 0) 	$this->id = $id;

		$items = $this->Comanda->DetalleComanda->find('count',array(
                                                    'conditions'=>array(
                                                            'Comanda.mesa_id'=>$this->id,
                                                            '(DetalleComanda.cant - DetalleComanda.cant_eliminada) >'=>0),
                                                    'order'=>'Comanda.id ASC, Producto.categoria_id ASC, Producto.id ASC',
                                                    'contain'=>array('Producto','Comanda','DetalleSabor'=>'Sabor(name,precio)')
						));

		return $items;
        }
	
	
	
	/**
	 * Me devuelve ellistado de productos de una mesa en especial
	 *
	 */
	function listado_de_productos($id = 0)
	{
		if($id != 0) 	$this->id = $id;	
		
		$items = $this->Comanda->DetalleComanda->find('all',array(
									'conditions'=>array(
										'Comanda.mesa_id'=>$this->id,
										'(DetalleComanda.cant - DetalleComanda.cant_eliminada) >'=>0),
									'order'=>'Comanda.id ASC, Producto.categoria_id ASC, Producto.id ASC',
									'contain'=>array('Producto','Comanda','DetalleSabor'=>'Sabor(name,precio)')
						));
		for($i=0; $i<count($items); $i++){
			$items[$i]['DetalleComanda']['cant_final'] = $items[$i]['DetalleComanda']['cant']-	$items[$i]['DetalleComanda']['cant_eliminada'];
		}
		
		return $items;
	}


        function ultimasCobradas($limit = 20){

		$conditions = array("Mesa.estado_id >=" => MESA_COBRADA);

                $mesas = $this->find('all', array(
                    'conditions'=>$conditions,
                    'limit' => $limit,
                    ));
		
		return $mesas;
	}
	
	
	
	function listado_de_abiertas($recursive = -1){
		
		$conditions = array("Mesa.estado_id" => MESA_ABIERTA);
		
		if($recursive>-1){
			$this->recursive = $recursive;			
			$mesas = $this->find('all', array('conditions'=>$conditions));
		}			
		else{
			$mesas = $this->find('all', array(
                            'conditions'=>$conditions,
                            'contain'=>array('Mozo(numero)')
                            ));
		}
		return $mesas;
	}


        function listadoAbiertasYSinCobrar($recursive = -1){

		$conditions = array("Mesa.estado_id <" => MESA_COBRADA);

		if($recursive>-1){
			$this->recursive = $recursive;
			$mesas = $this->find('all', array(
                            'conditions'=>$conditions));
		}
		else{
			$mesas = $this->find('all', array(
                            'conditions'=>$conditions,
                            'contain'=>array('Mozo(numero, id)')));
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
	function numero_de_mesa_existente($numero_mesa = 0){
		if($numero_mesa == 0){
		 	if(!empty($this->data['Mesa']['numero'])){
		 		$numero_mesa = $this->data['Mesa']['numero'];
		 	}
		 }		
		 
		$this->recursive = -1;
		$conditions = array(
                                    'estado_id'=>MESA_ABIERTA, 
                                    'numero'=>$numero_mesa);
		
		if(!empty($this->id)){
			if($this->id != ''){
				$conditions = array_merge($conditions, array('Mesa.id <>'=> $this->id));
		
			}
		}
		
		$result = $this->find('count',array('conditions'=>$conditions));

		return ($result>0)?true:false;
		
	}
	
	
	function getNumero($mesa_id = 0){
		if($mesa_id != 0){
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
        function getProductosSinDescripcion($cantMenues, $descripcion = 'Menu'){
            if ($descripcion == 'Menu' && ($descAux = Configure::read('Mesa.descripcionSinProductos'))){
                $descripcion = $descAux;
            }
            $prod[0]['nombre'] = $descripcion;
            $total = $this->calcular_subtotal();
            $prod[0]['precio'] = number_format( $total/$cantMenues, 2);
            $prod[0]['cantidad'] = $cantMenues;
            return $prod;
        }
	
	function dameProductosParaTicket($id = 0){
		if($id != 0) $this->id = $id;


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
                    $vItems[$cont]['precio'] = cqs_round($i['DetalleComanda']['precio'],2);
                    $cont++;
                }		
		
		return $vItems;
	}
	
	
	
	/**
	 * devuelve todaslasmesas cerradas orcdenadas por fecha de cierre ASC
	 * @return array mesas find(all)
	 */
	function todasLasCerradas(){
		$this->recursive = 0;
		$conditions = array('estado_id' => MESA_CERRADA);
		return $this->find('all',array('conditions'=>$conditions, 'order'=>'time_cerro'));
	}



        /**
         * Dice si una mesa esta cerrada o no
         * @param integer $id
         * @return boolean
         */
        function estaCerrada($id = null){
            if (!empty($id)){
                $this->id = $id;
            }
            // si lo tengo en memoria primero busco por aca
            if (!empty($this->data[$this->name]['estado_id'])){
                return $this->data[$this->name]['estado_id'] == MESA_CERRADA;
            }
            // lo busco en BBDD        
            $ret = $this->find('count', array(
                'conditions' => array(
                    'Mesa.estado_id' => MESA_CERRADA,
                    'Mesa.id' => $this->id,

                )
            ));

            if ($ret > 0) return false;
            else return true;
        }
        
        
        
        
        /**
         * Dice si una mesa esta abierta o no
         * @param integer $id
         * @return boolean
         */
        function estaAbierta($id = null){
            if (!empty($id)){
                $this->id = $id;
            }
            // si lo tengo en memoria primero busco por aca
            if ( !empty($this->data[$this->name]['estado_id']) ){
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


        function reabrir($mesa_id = null){
            if (!empty($mesa_id)) {
                $this->id = $mesa_id;
            }
            $this->Pago->deleteAll(array(
                'mesa_id' => $mesa_id
            ), $cascada = false);
            $result = $this->saveField('estado_id', MESA_ABIERTA);
        }
        
        
        
        
        /**
         * Me devuelve un listado agrupado por dia de mesas. Util para estadistica y contabilidad
         * @param type $fechaDesde string formato de fecha debe ser del tip AÑO-mes-dia Y-m-d
         * @param type $fechaHasta string formato de fecha debe ser del tip AÑO-mes-dia Y-m-d
         * @param type $conds array de condiciones extra
         */
        function totalesDeMesasEntre($fechaDesde = '', $fechaHasta = '', $conds = array()){
            $horarioCorte = Configure::read('Horario.corte_del_dia');
            $limit = empty($conds['limit']) ? '' : $conds['limit'];
            $desde = empty($fechaDesde) ? date('Y-m-d', strtotime('now')) : $fechaDesde;
            $hasta = empty($fechaHasta) ? date('Y-m-d', strtotime('now')) : $fechaHasta;
            
            $fieldConds = empty($conds['fields']) ? array() : $conds['fields'];
            $fields = array_merge( array( 'count(*) as "cant_mesas"'), $fieldConds );
            
            $groups = empty($conds['fields']) ? array() : $conds['group'];
            
            $fieldsText = '';
            $i = 0;
            foreach ($fields as $f){
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
                foreach ($groups as $g){
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
                foreach ($order as $o){
                    if ($i > 0) {
                        $orderByText .= ', ';
                    }
                    $orderByText .= $o;
                    $i++;
                }
            }
            
            $query = '    SELECT 
                    '.$fieldsText.'
FROM (
    SELECT m.id, m.numero, m.mozo_id, m.total,m.subtotal, m.cant_comensales, 
    m.cliente_id, m.menu, ADDDATE(m.created,-1) as created, m.modified, m.time_cerro, m.time_cobro 
    FROM mesas m
    WHERE m.deleted = 0 AND DATE(m.created) BETWEEN DATE(ADDDATE("'.$desde.'",+1)) AND DATE(ADDDATE("'.$hasta.'",+1)) 
          AND HOUR(m.created) BETWEEN 0 AND '. $horarioCorte.'
UNION
    SELECT id,numero,mozo_id,total, m.total, cant_comensales, cliente_id,menu, created, modified, time_cerro, time_cobro 
    FROM mesas m
    WHERE m.deleted = 0 AND DATE(m.created) BETWEEN "'.$desde.'" AND "'.$hasta.'" AND HOUR(m.created) BETWEEN '.$horarioCorte.' AND 24) as m    
              
LEFT JOIN mozos z ON z.id = m.mozo_id              
'. $groupByText .'
'. $orderByText. '    
'. $limit;
            return $this->query($query);
        }
}
?>