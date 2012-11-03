<?php

// pongo el ESC para comenzar ESC/P
$textoAImprimir .=ESC.'@';

//DOBLE_ALTO
$textoAImprimir .=ESC.DOBLE_ALTO;

// IMPRIMO EL HEADER
if($productos[0]['Comanda']['prioridad']){
        $header = " - $title # $comanda_id -";
        $textoAImprimir .='*****************************************';
        $textoAImprimir .="\n";
        $textoAImprimir .='*********** COMANDA PRIORIDAD ***********';
        $textoAImprimir .="\n";
        $textoAImprimir .="                 #$comanda_id";
        $textoAImprimir .="\n";
        $textoAImprimir .='*****************************************';
        $textoAImprimir .="\n\n";
}else{
        $textoAImprimir .="              Comanda  #$comanda_id";
        $textoAImprimir .="\n\n";
}




foreach($prod_a_imprimir as $item){
        if (!$textoAImprimir .= $item ){
            throw new Exception("no se puede escribir en el archivo: $arch_name");
        }
        $textoAImprimir .= "\n";
}	


if($productos[0]['Comanda']['observacion']){
        $textoAImprimir .="\n";
        $textoAImprimir .='||||||||||||    OBSERVACION     |||||||||';
        $textoAImprimir .="\n";
        $textoAImprimir .= $productos[0]['Comanda']['observacion'];
        $textoAImprimir .="\n";
        $textoAImprimir .='|||||||||||||||||||||||||||||||||||||||||';
        $textoAImprimir .="\n";
        $textoAImprimir .="\n";
}

$textoAImprimir .="\n";


// DOBLE ANCHO
$textoAImprimir .=ESC.ENFATIZADO;
$tail = " - Mesa #: ".$productos[0]['Comanda']['Mesa']['numero'];
$textoAImprimir .=$tail;
// SACA DOBLE ANCHO
$textoAImprimir .=ESC.SACA_ENFATIZADO;


$textoAImprimir .="\n";
// DOBLE ANCHO
$textoAImprimir .=ESC.ENFATIZADO;
$tail = " - Mozo #: ".$productos[0]['Comanda']['Mesa']['Mozo']['numero'];
$textoAImprimir .=$tail;
// SACA DOBLE ANCHO
$textoAImprimir .=ESC.SACA_ENFATIZADO;


$textoAImprimir .=ESC.SACA_DOBLE_ALTO;

$textoAImprimir .="\n";

$tail ="                          ".date('H:i:s',strtotime('now'))."\n";
$textoAImprimir .=$tail;



//  retorno de carro
$textoAImprimir .=chr(13);
$textoAImprimir .='-  -  -  -  -  -  -  -  -  -  -  -  -  -  -';
$textoAImprimir .="\n";
$textoAImprimir .="\n";
$textoAImprimir .="\n";
$textoAImprimir .="\n";
$textoAImprimir .="\n";
$textoAImprimir .="\n";
$textoAImprimir .="\n";					

// probando corte completo ESC/P
$textoAImprimir .=ESC.CORTAR_PAPEL;
