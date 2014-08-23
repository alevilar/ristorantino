<?php


App::uses('CashAppController', 'Cash.Controller');


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

        $this->Paginator->settings['conditions'] = $conditions;
        $zetas = $this->Paginator->paginate();
        $this->set(compact('zetas'));
        
    }
}
    