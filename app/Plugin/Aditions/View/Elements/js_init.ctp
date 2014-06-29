        
<script type="text/javascript">
    <!--
          $.extend(  $.mobile , {
            backBtnText: "Volver"
          });
        
        <?php 
        $animar = Configure::read('Adicion.jqm_page_transition');
        if ( empty($animar) ){ 
            if (!$animar) {
            ?>
              $.extend(  $.mobile , {
                defaultPageTransition: 'none',
                defaultDialogTransition: 'none'
              });
        <?php }} ?>
            
            
        Risto.TITULO_MESA = "<?php echo Configure::read('Mesa.tituloMesa')?>";
        Risto.TITULO_MOZO = "<?php echo Configure::read('Mesa.tituloMozo')?>";
        
        
        // intervalo en milisegundos en el que seran renovadas las mesas
        <?php 
        $RELOAD_INTERVAL =  Configure::read('Adicion.reload_interval');
        if (empty($RELOAD_INTERVAL)) {
            $RELOAD_INTERVAL = 5000;
        }
        ?>
        Risto.MESAS_RELOAD_INTERVAL = <?php echo $RELOAD_INTERVAL; ?>;
//        Risto.MESA_RELOAD_TIMEOUT = <?php echo Configure::read('Adicion.reload_interval_timeout')?>;
        
        Risto.VALOR_POR_CUBIERTO = <?php 
                                    $valorCubierto = Configure::read('Restaurante.valorCubierto');
                                    echo $valorCubierto > 0 ? $valorCubierto : 0;  ?>;
        
        // hace que luego de cobrar una mesa, esta quede activa durante X segundos
//        Risto.ESPERAR_DESPUES_DE_COBRAR = 0;
        
        
        Risto.IMPRIME_REMITO_PRIMERO = <?php echo Configure::read('Mesa.imprimePrimeroRemito')?1:0?>;

        //Parametros de configuracion
        Risto.Adition.cubiertosObligatorios   = <?php echo Configure::read('Adicion.cantidadCubiertosObligatorio')?'true':'false'?>;


        // instancio el objeto adicion que sera el kernel de la app
        Risto.Adition.adicionar.initialize();
        
    -->
    </script>