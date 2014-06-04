<?php
function mostrarNetoDe($tipoImpuestoId, $vec)
{
    foreach ($vec as $v) {
        if ($v['tipo_impuesto_id'] == $tipoImpuestoId) {
            return $v['neto'];
        }
    }
    return 0;
}

function mostrarImpuestoDe($tipoImpuestoId, $vec)
{
    foreach ($vec as $v) {
        if ($v['tipo_impuesto_id'] == $tipoImpuestoId) {
            return $v['importe'];
        }
    }
    return 0;
}

class AccountAppController extends AppController
{

    var $helpers = array('Html', 'Form','Javascript', 'Jqm');
    
    function beforeFilter() {
        parent::beforeFilter();
        
        $this->set('elementMenu', 'menu');

        $this->Auth->loginAction = array('controller' => 'users',
                'action' => 'login', 'admin' => false, 'plugin' => null);
    }

}

?>
