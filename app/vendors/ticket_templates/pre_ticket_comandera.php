<?
// pongo el ESC para comenzar ESC/P
    $textoAImprimir .= ESC.'@';


    /*****
     * 				 ENCABEZADO
     */
    $header = Configure::read('Restaurante.name');
    if ($header) {
        $textoAImprimir .= $header;
        $textoAImprimir .= "\n\n";
    }

    if (Configure::read('Restaurante.razon_social')){
        $textoAImprimir .= Configure::read('Restaurante.razon_social');
        $textoAImprimir .= "\n";
    }
    if (Configure::read('Restaurante.cuit')){
        $textoAImprimir .= Configure::read('Restaurante.cuit');
        $textoAImprimir .= "\n";
    }
    if (Configure::read('Restaurante.ib')){
        $textoAImprimir .= Configure::read('Restaurante.ib');
        $textoAImprimir .= "\n";
    }
    if (Configure::read('Restaurante.iva_resp')){
        $textoAImprimir .= Configure::read('Restaurante.iva_resp');
        $textoAImprimir .= "\n";
    }
    $textoAImprimir .= 'Fecha: '.date('d/m/y',strtotime('now')).'   Hora: '.date('H:i:s',strtotime('now'));
    $textoAImprimir .= "\n";
    $textoAImprimir .= "\n";
    $textoAImprimir .= "\n";

    $textoAImprimir .= 'Cant. P.Unit. Item               Total';
    $textoAImprimir .= "\n";


    foreach($prod_a_imprimir as $item){
            if(!$textoAImprimir .= $item) throw new Exception("no se puede escribir en el archivo: $arch_name");
            $textoAImprimir .= "\n";
    }



    $descuento = $porcentaje_descuento/100;
    $total_c_descuento = cqs_round($total - ($total*$descuento));

    if($porcentaje_descuento){
            $tail = " -     SUBTOTAL                $$total";
            $textoAImprimir .= $tail;
            $textoAImprimir .= "\n";

            $tail = " -     DTO.                   -%$porcentaje_descuento";
            $textoAImprimir .= $tail;
            $textoAImprimir .= "\n";
    }

            $tail = " -     TOTAL                   $".$total_c_descuento;
    $textoAImprimir .= $tail;

    $textoAImprimir .= "\n\n";

    $tail  = " \n - MOZO: ".$mozo;
    $tail .= " \n - MESA: ".$mesa."\n";
    $textoAImprimir .= $tail;

    //  retorno de carro
    $textoAImprimir .= chr(13);

    $textoAImprimir .= '  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -';
    $textoAImprimir .= "\n";
    $textoAImprimir .= '           Verifique antes de abonar';
    $textoAImprimir .= "\n";
    $textoAImprimir .= '        NO VALIDO COMO COMPROBANTE FISCAL';
    $textoAImprimir .= "\n";
    $textoAImprimir .= "\n";
    $textoAImprimir .= "\n";
    $textoAImprimir .= "\n";
    $textoAImprimir .= "\n";
    $textoAImprimir .= "\n";
    $textoAImprimir .= "\n";



    // probando corte completo ESC/P
    $textoAImprimir .= ESC.'i';
                                        
?>