<?php 
class MesaFixture extends CakeTestFixture {
	

	
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'numero'=> 	array('type' => 'integer'),
		'mozo_id'=> array('type' => 'integer'),
	 	'total'=> array('type' => 'float'),
	 	'cliente_id'=> array('type' => 'integer'),
	 	'menu'=> array('type' => 'integer'),
		'created'=> array('type' => 'datetime'),
	 	'modified'=> array('type' => 'datetime'),
	 	'time_cerro'=> array('type' => 'datetime'),
	 	'time_cobro'=> array('type' => 'datetime')
	);
	
	var $records = array(array(
		'id'=>1,
		'mozo_id'=>1,
		'numero'=>50,
	 	'total'=>0,
	 	'cliente_id'=>0,
	 	'menu'=>0,	
		'created' => date("Y-m-d H:i:s",strtotime('now')),
	 	'time_cerro' => '0000-00-00 00:00:00',
	 	'time_cobro'=> '0000-00-00 00:00:00'	
	));

}

?>