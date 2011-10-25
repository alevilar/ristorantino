<?

// pongo el ESC para comenzar ESC/P
    fwrite($archivo_comanda,ESC.'@');




    /*****
     * 				 ENCABEZADO
     */
    $header = Configure::read('Restaurante.name');
    if ($header) {
        fwrite($archivo_comanda,$header);
        fwrite($archivo_comanda,"\n\n");
    }

    if (Configure::read('Restaurante.razon_social')){
        fwrite($archivo_comanda,Configure::read('Restaurante.razon_social'));
        fwrite($archivo_comanda,"\n");
    }
    if (Configure::read('Restaurante.cuit')){
        fwrite($archivo_comanda,Configure::read('Restaurante.cuit'));
        fwrite($archivo_comanda,"\n");
    }
    if (Configure::read('Restaurante.ib')){
        fwrite($archivo_comanda,Configure::read('Restaurante.ib'));
        fwrite($archivo_comanda,"\n");
    }
    if (Configure::read('Restaurante.iva_resp')){
        fwrite($archivo_comanda,Configure::read('Restaurante.iva_resp'));
        fwrite($archivo_comanda,"\n");
    }
    fwrite($archivo_comanda,'Fecha: '.date('d/m/y',strtotime('now')).'   Hora: '.date('H:i:s',strtotime('now')));
    fwrite($archivo_comanda,"\n");
    fwrite($archivo_comanda,"\n");
    fwrite($archivo_comanda,"\n");

    fwrite($archivo_comanda,'Cant. P.Unit. Item               Total');
    fwrite($archivo_comanda,"\n");


    foreach($prod_a_imprimir as $item){
            if(!fwrite($archivo_comanda,$item)) throw new Exception("no se puede escribir en el archivo: $arch_name");
            fwrite($archivo_comanda,"\n");
    }



    $descuento = $porcentaje_descuento/100;
    $total_c_descuento = cqs_round($total - ($total*$descuento));

    if($porcentaje_descuento){
            $tail = " -     SUBTOTAL                $$total";
            fwrite($archivo_comanda,$tail);
            fwrite($archivo_comanda,"\n");

            $tail = " -     DTO.                   -%$porcentaje_descuento";
            fwrite($archivo_comanda,$tail);
            fwrite($archivo_comanda,"\n");
    }

            $tail = " -     TOTAL                   $".$total_c_descuento;
    fwrite($archivo_comanda,$tail);

    fwrite($archivo_comanda,"\n\n");

    $tail  = " \n - MOZO: ".$mozo;
    $tail .= " \n - MESA: ".$mesa."\n";
    fwrite($archivo_comanda,$tail);

    //  retorno de carro
    fwrite($archivo_comanda,chr(13));

    fwrite($archivo_comanda,'  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -');
    fwrite($archivo_comanda,"\n");
    fwrite($archivo_comanda,'           Verifique antes de abonar');
    fwrite($archivo_comanda,"\n");
    fwrite($archivo_comanda,'        NO VALIDO COMO COMPROBANTE FISCAL');
    fwrite($archivo_comanda,"\n");
    fwrite($archivo_comanda,"\n");
    fwrite($archivo_comanda,"\n");
    fwrite($archivo_comanda,"\n");
    fwrite($archivo_comanda,"\n");
    fwrite($archivo_comanda,"\n");
    fwrite($archivo_comanda,"\n");



    // probando corte completo ESC/P
    fwrite($archivo_comanda,ESC.'i');
                                        
?>