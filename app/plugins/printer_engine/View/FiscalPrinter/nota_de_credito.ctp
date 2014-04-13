<?php

$tipoId = $tipo == 'B' ? 'S' : 'R';
if (!empty($cliente) && $tipo == 'A') {
    $this->vcomandos[] = $this->generadorComando->setCustomerData($cliente['razonsocial'], $cliente['numerodoc'], $cliente['respo_iva'], $cliente['tipodoc']);
} else {
    //condumidor Final
    $this->vcomandos[] = $this->generadorComando->setCustomerData();
}
$this->vcomandos[] = $this->generadorComando->setEmbarkNumber($numeroTicket);
$this->vcomandos[] = $this->generadorComando->openDNFH($tipoId);
$this->vcomandos[] = $this->generadorComando->printLineItem($descrip, 1, $importe);
$this->vcomandos[] = $this->generadorComando->closeDNFH();