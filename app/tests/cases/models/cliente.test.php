<?php 
/* SVN FILE: $Id$ */
/* Cliente Test cases generated on: 2009-10-24 20:10:29 : 1256425229*/
App::import('Model', 'Cliente');

class TestCliente extends Cliente {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class ClienteTestCase extends CakeTestCase {
	var $Cliente = null;
	var $fixtures = array('app.cliente', 'app.user', 'app.descuento', 'app.mesa');

	function start() {
		parent::start();
		$this->Cliente = new TestCliente();
	}

	function testClienteInstance() {
		$this->assertTrue(is_a($this->Cliente, 'Cliente'));
	}

	function testClienteFind() {
		$this->Cliente->recursive = -1;
		$results = $this->Cliente->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Cliente' => array(
			'id'  => 1,
			'user_id'  => 1,
			'descuento_id'  => 1,
			'tipofactura'  => 'Lorem ipsum dolor sit ame',
			'imprime_ticket'  => 1,
			'nombre'  => 'Lorem ipsum dolor sit amet',
			'nrodocumento'  => 'Lorem ips',
			'tipodocumento'  => 'Lorem ipsum dolor sit ame',
			'domicilio'  => 'Lorem ipsum dolor sit amet',
			'responsabilidad_iva'  => 'Lorem ipsum dolor sit ame',
			'created'  => 'Lorem ipsum dolor sit ame',
			'modified'  => 'Lorem ipsum dolor sit ame'
			));
		$this->assertEqual($results, $expected);
	}
}
?>