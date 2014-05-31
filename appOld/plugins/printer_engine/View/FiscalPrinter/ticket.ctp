<?php

//setteo el pie de pagina con el numero de mozo y mesa

echo $this->PE->setTrailer(0, "-  -  -  -  -  -  -  -"); echo "\n";

if ($mozoTitle = Configure::read('Mesa.tituloMozo')) {
    echo $this->PE->setTrailer(1, "$mozoTitle $mozo ", true); echo "\n";
} else { // no escribir nada
    echo $this->PE->setTrailer(1, " ", true); echo "\n";
}

if ($mesaTitle = Configure::read('Mesa.tituloMesa')) {
    echo $this->PE->setTrailer(2, "$mesaTitle $mesa", true); echo "\n";
} else { // no escribir nada
    echo $this->PE->setTrailer(2, " ", true); echo "\n";
}

echo $this->PE->setTrailer(3, "-  -  -  -  -  -  -  -"); echo "\n";


echo $this->PE->setTrailer(6, "  ORIENTACION AL COSUMIDOR PROVINCIA"); echo "\n";
echo $this->PE->setTrailer(7, "     DE BUENOS AIRES 0-800-333-6422"); echo "\n";



//abro el tiquet consumidor final
if (!empty($cliente)) {
    echo $this->PE->setCustomerData($cliente['nombre'], 
                                    $cliente['nrodocumento'], 
                                    $cliente['responsabilidad_iva'], 
                                    $cliente['tipodocumento'], 
                                    $cliente['domicilio']
    ); echo "\n";
}

//abro el tiquet poniendo la condicion ante el iva seleccionada
echo $this->PE->openFiscalReceipt($tipo_factura); echo "\n";



//inserto los productos en vcomandas y cierro la mesa
if (!empty($productos)) {
    foreach ($productos as $p) {
        echo $this->PE->printLineItem(
                $p['nombre'], $p['cantidad'], $p['precio']); echo "\n";
//echo "B".FS.$p['nombre'].FS.$p['cantidad'].FS.$p['precio'].FS."21.00".FS."M".FS."0.11".FS."1".FS."T";
    }
}

if (!empty($importe_descuento)) {
    echo $this->PE->generalDiscount($importe_descuento); echo "\n";
}

echo $this->PE->closeFiscalReceipt(); echo "\n";



