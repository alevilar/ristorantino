<?php
App::uses('AppController', 'Controller');
/**
 * CreacionComandas Controller
 *
 * @property Categoria $Categoria
 */
class CreacionComandasController extends AditionAppController
{
    public $uses = array( 'Categoria' );
    
    public $layout = 'loco';


    function add() {        
        $cat1 = $this->Categoria->array_listado();
        $this->set('categorias', $cat1);
    }

}
