<?php
App::uses('FidelizationAppController', 'Fidelization.Controller');
/**
 * Clientes Controller
 *
 * @property Cliente $Cliente
 * @property PaginatorComponent $Paginator
 */
class DescuentosController extends FidelizationAppController {


	public $scaffoldFields = array("name", "description", "porcentaje");

	public $scaffold;

	public function beforeRender ( ) {
		$this->set('scaffoldFields', $this->scaffoldFields);
	}
}