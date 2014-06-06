<?php

class ZetasController extends CashAppController
{


    public function index()
    {        
        $conditions = array();
        $url = $this->params['url'];
        unset($url['ext']);
        unset($url['url']);
        if (!empty($url['fecha_desde'])) {
            $conditions['Zeta.created >='] = $url['fecha_desde'];
            $this->request->data['Zeta']['fecha_desde'] = $url['fecha_desde'];
        }
        
        if (!empty($url['fecha_hasta'])) {
            $conditions['Zeta.created <='] = $url['fecha_hasta'];
            $this->request->data['Zeta']['fecha_hasta'] = $url['fecha_hasta'];
        }

        $this->paginate['conditions'] = $conditions;
        $zetas = $this->paginate();
        $this->set(compact('zetas'));
        
        if ($this->params['url']['ext'] == 'xls' ) {
            $this->layout = 'xls';
            $this->render( 'xls/'.$this->action );
        }
    }
}
    