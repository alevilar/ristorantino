<?php

App::uses('AppModel', 'Mesa.Model');

class Mesa extends MesaAppModel {

	public $name = 'Mesa';

  public $displayField = 'numero';

	public $actsAs = array(
        'SoftDelete', 
        'Search.Searchable',
        'Containable',
        );

    public $mozoNumero = 0;

    public $validate = array(
        'mozo_id' => array(
         'notempty',
         'numeric',
         ),
        'numero' => array(
         'notempty',
         'numeric',	
         ));


    public $defaultContain = array(
                    'Mozo',
                    'Cliente' => array(
                        'Descuento',
                        'TipoDocumento',
                        'IvaResponsabilidad.TipoFactura',
                        ),
                    'Descuento',
                    'Estado',
                    'Comanda' => array(
                        'DetalleComanda' => array(
                            'Producto',
                            'DetalleSabor.Sabor'),
                    ),
    );

    public $filterArgs = array(
        'numero' => array(
            'type' => 'value',
            ),
        'estado_id' => array(
            'type' => 'value',
            ),
        'mozo_numero' => array(
            'type' => 'value',
            'field' => 'Mozo.numero'
            ),
        'deleted' => array(
            'type' => 'value',
            ),
        'total' => array(
            'type' => 'value'
            ),        
        'created_from' => array(
            'type' => 'value',
            'field' => 'Mesa.created >='
            ),
        'created_to' => array(
            'type' => 'value',
            'field' => 'Mesa.created <='
            ),
        'time_cerro_from' => array(
            'type' => 'value',
            'field' => 'Mesa.time_cerro >='
            ),
        'time_cerro_to' => array(
            'type' => 'value',
            'field' => 'Mesa.time_cerro <='
            ),
        'time_cobro_from' => array(
            'type' => 'value',
            'field' => 'Mesa.time_cobro >='
            ),
        'time_cobro_to' => array(
            'type' => 'value',
            'field' => 'Mesa.time_cobro <='
            ),
        );



        /*
         * Valor total de una mesa Objeto en particular.
         * Es el array que devuelve la funcion calcular_total()
         * @public $total float
         */
        public $total = array();


        /**
         * belongsTo associations
         *
         * @var array
         */
        public $belongsTo = array(
            'Mesa.Estado',
            'Mesa.Mozo',
            'Fidelization.Cliente',
            'Fidelization.Descuento',
        );



        public $hasMany = array(   
          'Comanda' => array(
            'className' => 'Comanda.Comanda',
            'dependent' => true,
            'order' => 'Comanda.created DESC'
            ), 
          'Pago' => array(
            'className' => 'Mesa.Pago',
            'dependent' => true,
            'order' => 'Pago.created'
            ),         
        );


    public $order = array('Mesa.created' => 'desc');
        
        
    function beforeSave( $options = array() ) 
    {
         $this->__deletePagosSiReabre();
         return parent::beforeSave($options);
     }



    // Si la mesa estaba cobrada, y la paso a un estado anterio, por ejemplo, la abro
    // enctonces debo eliminar todos los pagos realizados para que no me los duplique
    // cuando la vuelva a cobrar
     private function __deletePagosSiReabre () {
         if ( !empty($this->data['Mesa']['id']) 
             && !empty($this->data['Mesa']['estado_id'])
             && $this->data['Mesa']['estado_id'] != MESA_COBRADA
             ) {               
             if ( $this->estaCobrada($this->data['Mesa']['id'], $force_db = true) ) {
                
                 $this->Pago->deleteAll(array(
                  'Pago.mesa_id' => $this->data['Mesa']['id']
                  ));
                 
             }
         }
     }


    //  function getMozoNumero($id = null)
    //  {
    //     if (!empty($id)) {
    //         $this->id = $id;
    //     }
    //     if(empty($this->mozoNumero)){
    //         $mozo = $this->find('first', array(
    //             'conditions' => array('Mesa.id'=>$this->id),
    //             'contain' => array('Mozo')
    //             ));
    //         $this->mozoNumero = $mozo['Mozo']['numero'];
    //     }

    //     return $this->mozoNumero;
    // }


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

                // si no estoy usando cajero, entonces poner como que ya esta cerrada y cobrada
      if (!Configure::read('Adicion.usarCajero'))  {
        $mesaData['Mesa']['time_cobro'] = date( "Y-m-d H:i:s",strtotime('now'));
        $mesaData['Mesa']['estado_id']  = MESA_COBRADA;
    } else {
        $mesaData['Mesa']['time_cobro'] = DATETIME_NULL;
    }

    if ( $this->save($mesaData, false) ) {
        $this->printFiscalEvent( $mesa_id );
    } else {
        throw new Exception("Error al guardar para cerrar mesa");
    }


    return $mesaData;

}



function calcular_total_productos ($id = null) {
    if (!empty($id)) $this->id = $id;

    $this->Comanda->

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

    if ( !empty($this->total) ) {
        return $this->total['Mesa']['subtotal'];
    }

    $this->total['Mesa']['subtotal'] = 0;
    $this->total['Mesa']['total'] = 0;
    $this->total['Mesa']['descuento'] = 0;

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
        return null;
        $items = $this->Comanda->DetalleComanda->find('count',array(
            'conditions'=>array(
                'Comanda.mesa_id'=>$this->id,
                '(DetalleComanda.cant - DetalleComanda.cant_eliminada) >'=>0),
            'order'=>'Comanda.id ASC, Producto.categoria_id ASC, Producto.id ASC',
            'contain'=>array( 
              'Producto',
              'Comanda',
              'DetalleSabor' => 'Sabor(name,precio)'
              )
            )
        );

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



 //  function listado_de_abiertas($recursive = -1){

 //      $conditions = array("Mesa.estado_id" => MESA_ABIERTA);

 //      if($recursive>-1){
 //         $this->recursive = $recursive;			
 //         $mesas = $this->find('all', array('conditions'=>$conditions));
 //     }			
 //     else{
 //         $mesas = $this->find('all', array(
 //            'conditions'=>$conditions,
 //            'contain'=>array('Mozo(numero)')
 //            ));
 //     }
 //     return $mesas;
 // }


//  function listadoAbiertasYSinCobrar($recursive = -1){

//   $conditions = array("Mesa.estado_id <" => MESA_COBRADA);

//   if($recursive>-1){
//      $this->recursive = $recursive;
//      $mesas = $this->find('all', array(
//         'conditions'=>$conditions));
//  }
//  else{
//      $mesas = $this->find('all', array(
//         'conditions'=>$conditions,
//         'contain'=>array('Mozo(numero, id)')));
//  }

//             //debug($mesas);
//  return $mesas;
// }


	/**
	 * nos dice si el numero de mesa existe o no
	 * 
	 * @param integer numero demesa
	 * @return boolean
	 */
// 	function numero_de_mesa_existente($numero_mesa = 0){
// 		if($numero_mesa == 0){
//             if(!empty($this->data['Mesa']['numero'])){
//                $numero_mesa = $this->data['Mesa']['numero'];
//            }
//        }		

//        $this->recursive = -1;
//        $conditions = array(
//         'estado_id'=>MESA_ABIERTA, 
//         'numero'=>$numero_mesa);

//        if(!empty($this->id)){
//          if($this->id != ''){
//             $conditions = array_merge($conditions, array('Mesa.id <>'=> $this->id));

//         }
//     }

//     $result = $this->find('count',array('conditions'=>$conditions));

//     return ($result>0)?true:false;

// }


// function getNumero($mesa_id = 0){
//   if($mesa_id != 0){
//      $this->id = $mesa_id;
//  }
//  $mesa = $this->read();
//  return $mesa['Mesa']['numero'];

// }


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
        // function getProductosSinDescripcion($cantMenues, $descripcion = 'Menu'){
        //     if ($descripcion == 'Menu' && ($descAux = Configure::read('Mesa.descripcionSinProductos'))){
        //         $descripcion = $descAux;
        //     }
        //     $prod[0]['nombre'] = $descripcion;
        //     $total = $this->calcular_subtotal();
        //     $prod[0]['precio'] = number_format( $total/$cantMenues, 2);
        //     $prod[0]['cantidad'] = $cantMenues;
        //     return $prod;
        // }

    //     function dameProductosParaTicket($id = 0){
    //       if($id != 0) $this->id = $id;


    //       $items = $this->query("
    //         select sum(cant-cant_eliminada) as cant, name as 'name', precio as precio from (
    //             select
    //             dc.cant,
    //             dc.cant_eliminada,
    //             p.abrev as name,
    //             p.precio +  IFNULL((
    //                 select IFNULL(sum(s.precio),0) from detalle_sabores ds
    //                 left join sabores s on s.id = ds.sabor_id
    //                 where ds.detalle_comanda_id = dc.id
    //                 group by ds.detalle_comanda_id
    //                 ),0) precio,
    //       dc.id,
    //       p.order as orden
    //       from
    //       comandas c
    //       left join detalle_comandas dc on dc.comanda_id = c.id
    //       left join detalle_sabores ds on ds.detalle_comanda_id = dc.id
    //       left join productos p on p.id = dc.producto_id
    //       where c.mesa_id = $this->id
    //       group by dc.id
    //       ) as DetalleComanda
    //       group by name, precio
    //       having cant > 0
    //       order by orden
    //       ");

    //       $vItems = array();
    //       $cont = 0;
    //       foreach ($items as &$i) {
    //         $vItems[$cont]['nombre'] = $i['DetalleComanda']['name'];
    //         $vItems[$cont]['cantidad'] = $i[0]['cant'];
    //         $vItems[$cont]['precio'] = cqs_round($i['DetalleComanda']['precio'],2);
    //         $cont++;
    //     }		

    //     return $vItems;
    // }



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
        // function estaCerrada($id = null){
        //     if (!empty($id)){
        //         $this->id = $id;
        //     }
        //     // si lo tengo en memoria primero busco por aca
        //     if (!empty($this->data[$this->name]['estado_id'])){
        //         return $this->data[$this->name]['estado_id'] == MESA_CERRADA;
        //     }
        //     // lo busco en BBDD        
        //     $ret = $this->find('count', array(
        //         'conditions' => array(
        //             'Mesa.estado_id' => MESA_CERRADA,
        //             'Mesa.id' => $this->id,

        //             )
        //         ));

        //     if ($ret > 0) return false;
        //     else return true;
        // }
        
        
        /**
         * Dice si una mesa esta cobrada o no
         * @param integer $id
         * @param boolean $force_db indica si quiero forzar para que busque en la BBDD
         * @return boolean
         */
        function estaCobrada($id = null, $force_db = false){
            $ret = false;
            if (!empty($id)){
                $this->id = $id;
            }
            
            if ( !empty($this->data[$this->name]['estado_id']) ){
                $ret = $this->data[$this->name]['estado_id'] == MESA_COBRADA;
            }
            
            if ( $force_db) {
                 // lo busco en BBDD        
                $ret = $this->find('count', array(
                    'conditions' => array(
                        'Mesa.estado_id' => MESA_COBRADA,
                        'Mesa.id' => $this->id,
                        )
                    ));
            }


            return $ret;
        }
        
        
        
        
        /**
         * Dice si una mesa esta abierta o no
         * @param integer $id
         * @return boolean
         */
        // function estaAbierta($id = null){
        //     if (!empty($id)){
        //         $this->id = $id;
        //     }
        //     // si lo tengo en memoria primero busco por aca
        //     if ( !empty($this->data[$this->name]['estado_id']) ){
        //         return $this->data[$this->name]['estado_id'] == MESA_ABIERTA;
        //     }
        //     // lo busco en BBDD        
        //     $ret = $this->find('count', array(
        //         'conditions' => array(
        //             'Mesa.estado_id' => MESA_ABIERTA,
        //             'Mesa.id' => $this->id,

        //             )
        //         ));

        //     return ($ret > 0);
        // }


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
            if ( $horarioCorte < 10 ) {
                $horarioCorte = "0$horarioCorte";
            }
            $sqlHorarioDeCorte = "DATE(SUBTIME(Mesa.created, '$horarioCorte:00:00'))";
            $desde = empty($fechaDesde) ? date('Y-m-d', strtotime('now')) : $fechaDesde;
            $hasta = empty($fechaHasta) ? date('Y-m-d', strtotime('now')) : $fechaHasta;
            $defaultOrder = array();
            
            $defaultFields = array(
                'count(*) as "cant_mesas"',
                'sum(Mesa.cant_comensales) as "cant_cubiertos"',
                'sum(Mesa.subtotal) as "subtotal"',
                'sum(Mesa.total) as "total"',
                'sum(Mesa.total)/sum(Mesa.cant_comensales) as "promedio_cubiertos"',
                "$sqlHorarioDeCorte as fecha",                
                );
            
            $defaultGroup = array(
                'fecha'  ,
                );
            if ( empty($conds['order'])) {
                $defaultOrder = array(
                    "Mesa.created DESC"
                    );
            }
            
            
            $defaultConditions = array(
                    'Mesa.deleted' => '0', // mesas no borradas
                    "$sqlHorarioDeCorte BETWEEN '$desde' AND '$hasta'"
                    );
            
            $ops = array(
                'fields' => $defaultFields,
                'conditions' => $defaultConditions,
                'group' => $defaultGroup,
                'order' => $defaultOrder,
                );
            
            $ops = array_merge_recursive($ops, $conds);
            $mesas =  $this->find('all', $ops);
            return $mesas;
        }



       /**
       * @param integer mesa_id Id de la mesa
       * @throws InternalErrorException si no se le pasa un ID de mesa
       */        
        function printFiscalEvent ( $mesa_id = null ) {
          if (empty($mesa_id)) {
            if ( empty($this->id) ) 
              throw new InternalErrorException("Se debe pasar el ID de la mesa para imprimir");
            $mesa_id = $this->id;
          }

          $event = new CakeEvent('Mesa.print', $this, array(
                  'id' => $mesa_id
              ));
          $this->getEventManager()->dispatch($event);
        }
    }
    ?>