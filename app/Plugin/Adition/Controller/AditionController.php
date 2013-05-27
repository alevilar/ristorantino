<?php

class AditionController extends AditionAppController
{

    public $helpers = array('Html', 'Form');
    public $uses = array('Mozo', 'Mesa');

    public function index()
    {
        $this->set('tipo_de_pagos', $this->Mozo->Mesa->Pago->TipoDePago->find('all'));
        $this->set('mozos', $this->Mozo->dameActivos());
        $this->set('categorias', ClassRegistry::init('Categoria')->find('all'));
        $this->set('categoriasTree', ClassRegistry::init('Categoria')->array_listado());
        $this->set('productos', ClassRegistry::init('Producto')->listadoCompleto());
        $this->set('observaciones', ClassRegistry::init('Observacion')->find('list', array('order' => 'Observacion.name')));
        $this->set('observacionesComanda', ClassRegistry::init('ObservacionComanda')->find('list', array('order' => 'ObservacionComanda.name')));
    }

    function cierre_z()
    {
        Printaitor::close('z');
    }

    function cierre_x()
    {
        Printaitor::close('z');
    }

    function nota_credito()
    {
        if (!empty($this->data)) {
            $cliente = array();
            if (!empty($this->data['Cliente']) && $this->data['Cajero']['tipo'] == 'A') {
                $cliente['razonsocial'] = $this->data['Cliente']['razonsocial'];
                $cliente['numerodoc'] = $this->data['Cliente']['numerodoc'];
                $cliente['respo_iva'] = $this->data['Cliente']['respo_iva'];
                $cliente['tipodoc'] = $this->data['Cliente']['tipodoc'];
            }

            Printaitor::imprimirNotaDeCredito(
                    $this->data['Cajero']['numero_ticket'], $this->data['Cajero']['importe'], $this->data['Cajero']['tipo'], $this->data['Cajero']['descripcion'], $cliente
            );
            $this->Session->setFlash("Se imprimió una nota de crédito");
        }
    }

    function print_dnf()
    {
        Printaitor::printDNF();

        $this->Session->setFlash("Se imprimió documento no fiscal");

        die("se imprimio un DNF");
    }

}