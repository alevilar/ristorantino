<?php

class ZetasController extends CashAppController
{


    public function index()
    {
        $zetas = $this->paginate();

        $this->set(compact('zetas'));
    }
}
    