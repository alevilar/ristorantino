<?php 

        echo ESC.'@'; // pongo el ESC para comenzar ESC/P 
        
        
        /*****
         * 				 ENCABEZADO
         */
        $header = Configure::read('Adicion.preTicketHeader');
        if ($header) {
            echo $header;
            echo "\n\n";
        }

        if (Configure::read('Restaurante.razon_social')){
            echo Configure::read('Restaurante.razon_social');
            echo "\n";
        }
        if (Configure::read('Restaurante.cuit')){
            echo Configure::read('Restaurante.cuit');
            echo "\n";
        }
        if (Configure::read('Restaurante.ib')){
            echo Configure::read('Restaurante.ib');
            echo "\n";
        }
        if (Configure::read('Restaurante.iva_resp')){
            echo Configure::read('Restaurante.iva_resp');
            echo "\n";
        }
        echo 'Fecha: '.date('d/m/y',strtotime('now')).'   Hora: '.date('H:i:s',strtotime('now'));
        echo "\n";
        echo "\n";
        echo "\n";

        echo 'Cant. P.Unit. Item               Total';
        echo "\n";


        foreach($items  as $item){
                echo $item;
                echo "\n";
        }



        $descuento = $porcentaje_descuento/100;
        $total_c_descuento = cqs_round($total - ($total*$descuento));

        if($porcentaje_descuento){
                $tail = " -     SUBTOTAL                $$total";
                echo $tail;
                echo "\n";

                $tail = " -     DTO.                   -%$porcentaje_descuento";
                echo $tail;
                echo "\n";
        }

                $tail = " -     TOTAL                   $".$total_c_descuento;
        echo $tail;

        echo "\n\n";

        $tail  = " \n - MOZO: ".$mozo;
        $tail .= " \n - MESA: ".$mesa."\n";
        echo $tail;

        //  retorno de carro
        echo chr(13);

        echo '  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -';
        echo "\n";
        echo '           Verifique antes de abonar';
        echo "\n";
        echo '        NO VALIDO COMO COMPROBANTE FISCAL';
        echo "\n";
        echo "\n";
        echo "\n";
        echo "\n";
        echo "\n";
        echo "\n";
        echo "\n";



        // probando corte completo ESC/P
        echo ESC.'i';
