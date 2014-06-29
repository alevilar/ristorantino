<?php
App::uses('PrintersAppModel', 'Printers.Model');
/**
 * Printer Model
 *
 */
class Printer extends PrintersAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'alias' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'driver' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);



	/**
	 * @param int $id Printer Id
	 */
	public function imprimirCierreZ ( $id = null ) {
		Printaitor::close('Z');
		throw new NotImplementedException("imprimirCierreZ no implementado");
	}

	public function imprimirCierreX ( $id = null ) {
		Printaitor::close('X');
		throw new NotImplementedException("imprimirCierreX no implementado");
	}

	public function imprimirTicket ( $id = null ) {
		Printaitor::send($dataToView, $printerName, $viewName);
		throw new NotImplementedException("imprimirTicket no implementado");
	}


	public function imprimirNotaDeCredito ( $id = null ) {
		throw new NotImplementedException("imprimirNotaDeCredito no implementado");
	}

	

	public function imprimirComanda ( $id = null ) {
		throw new NotImplementedException("imprimirComanda no implementado");
	}

	public function imprimirTexto ( $id = null ) {
		throw new NotImplementedException("imprimirTexto no implementado");
	}


}
