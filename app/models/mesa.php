<?php
class Mesa extends AppModel {

	var $name = 'Mesa';
	var $actsAs = array('Containable');


        var $numero = 0;
        var $mozoNumero = 0;

	
	var $validate = array(
		'numero' => array(
			'notempty',
			'numeric',
			'numero_de_mesa_inexistente' => array(
                         'rule' => array('numero_de_mesa_inexistente'),
                         'message'=> 'El número ya existe.'
            )	
	));
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Mozo' => array('className' => 'Mozo',
								'foreignKey' => 'mozo_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Cliente' => array('className' => 'Cliente',
								'foreignKey' => 'cliente_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);


	
	var $hasOne = array(
			'Pago' => array('className' => 'Pago',
								'foreignKey' => 'mesa_id',
								'dependent' => true,
								'conditions' => '',
								'fields' => '',
								'order' => '')
	);

	var $hasMany = array(
			'Comanda' => array('className' => 'Comanda',
								'foreignKey' => 'mesa_id',
								'dependent' => true,
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
				
		$result = $this->saveField('total', $this->calcular_total());
                
		$result = $this->saveField('time_cerro', date( "Y-m-d H:i:s",strtotime('now')));

                if (!Configure::read('usarCajero'))  {
                    $result = $this->saveField('time_cobro', date( "Y-m-d H:i:s",strtotime('now')));
                }
		
	}
	
	
	

	
	/**
	 * Calcula el total de la mesa cuyo id fue seteado en $this->Mesa->id 
	 * return @total el valor
	 */
	function calcular_total($id = null){
            if (!empty($id)) $this->id = $id;
            
            if ($this->cantidadDeProductos() == 0) return 0;
		$total =  $this->query("
				select sumadas.mesa_id as mesa_id,sum(total) as total, dd.descuento,  sum(total)*(1-dd.descuento/100) as total_con_descuento 
from (
	select c.mesa_id as mesa_id, sum(s.precio*(dc.cant-dc.cant_eliminada)) as total
	from comandas c
	left join detalle_comandas dc on (dc.comanda_id =  c.id)
	left join detalle_sabores ds on (ds.detalle_comanda_id =  dc.id)
	left join sabores s on (s.id = ds.sabor_id)
	where 
	c.mesa_id = $this->id AND
	(dc.cant-dc.cant_eliminada) > 0
UNION ALL
select c.mesa_id as mesa_id, sum(p.precio*(dc.cant-dc.cant_eliminada)) as total
	from comandas c
	left join detalle_comandas dc on (dc.comanda_id = c.id)
	left join productos p on (dc.producto_id = p.id)
	where 
	c.mesa_id = $this->id AND
	(dc.cant-dc.cant_eliminada) > 0
) as sumadas

LEFT JOIN

	(select mesa_id, IF(ISNULL(descuentos.porcentaje), 0 , descuentos.porcentaje) as descuento
		from detalle_comandas
		left join comandas on (comanda_id = comandas.id)
		left join mesas on (mesa_id = mesas.id)
		left join clientes on (clientes.id = mesas.cliente_id )
		left join descuentos on (clientes.descuento_id = descuentos.id)
		where 
		mesa_id = $this->id
		group by mesa_id
	) as dd on (dd.mesa_id = sumadas.mesa_id)
	group by sumadas.mesa_id				
										
		");
		
		$total = round($total[0][0]['total_con_descuento']);
		return $total ;	
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
	
	
	
	function listado_de_abiertas($recursive = -1){
		
		$conditions = array("Mesa.time_cobro" => "0000-00-00 00:00:00",
                                    "Mesa.time_cerro" => "0000-00-00 00:00:00");
		
		if($recursive>-1){
			$this->recursive = $recursive;			
			$mesas = $this->find('all', array('conditions'=>$conditions));
		}			
		else{
			$mesas = $this->find('all', array('conditions'=>$conditions,'contain'=>array('Mozo(numero)')));
		}
		return $mesas;
	}


        function listadoAbiertasYSinCobrar($recursive = -1){

		$conditions = array("Mesa.time_cobro" => "0000-00-00 00:00:00");

		if($recursive>-1){
			$this->recursive = $recursive;
			$mesas = $this->find('all', array(
                            'conditions'=>$conditions));
		}
		else{
			$mesas = $this->find('all', array(
                            'conditions'=>$conditions,
                            'contain'=>array('Mozo(numero)')));
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
							'time_cobro'=>'0000-00-00 00:00:00', 
							'numero'=>$numero_mesa);
		
		if(!empty($this->id)){
			if($this->id != ''){
				$conditions = array_merge($conditions, array('Mesa.id <>'=> $this->id));
		
			}
		}
		
		$result = $this->find('count',array('conditions'=>$conditions));

		return ($result>0)?true:false;
		
	}
	
	
	function numero_de_mesa_inexistente($numero_mesa = 0){
		 return ($this->numero_de_mesa_existente($numero_mesa))?false:true;
		 
	}
	
	
	function getNumero($mesa_id = 0){
		if($mesa_id != 0){
			$this->id = $mesa_id;
		}
		$mesa = $this->read();
		return $mesa['Mesa']['numero'];
		
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
                order by orden
                ");
                
                $vItems = array();
                $cont = 0;
                foreach ($items as &$i) {
                    $vItems[$cont]['nombre'] = $i['DetalleComanda']['name'];
                    $vItems[$cont]['cantidad'] = $i[0]['cant'];
                    $vItems[$cont]['precio'] = $i['DetalleComanda']['precio'];
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
		$conditions = array("time_cobro = '0000-00-00 00:00:00'",
							"time_cerro <> '0000-00-00 00:00:00'");
		return $this->find('all',array('conditions'=>$conditions, 'order'=>'time_cerro'));
	}
}
?>