<script type="text/javascript">
    <!--
                   
    (function(){
        $.mobile.buttonMarkup.hoverDelay = 0;
        // Prevents all anchor click handling
        //        $.mobile.linkBindingEnabled = false;

        // Disabling this will prevent jQuery Mobile from handling hash changes
        //        $.mobile.hashListeningEnabled = false;

        
        var jqmOps = {
            backBtnText: "Volver",
            defaultPageTransition: 'slide',
            defaultDialogTransition: 'pop'
        }
<?php
$animar = Configure::read('Adicion.jqm_page_transition');
if (empty($animar)) {
    if (!$animar) {
        ?>
                                jqmOps = {
                                    defaultPageTransition: 'none',
                                    defaultDialogTransition: 'none'
                                }
    <?php }
} ?>
                $.extend(  $.mobile , jqmOps);
            })();
       
            
            
            Risto.TITULO_MESA = "<?php echo Configure::read('Mesa.tituloMesa') ?>";
            Risto.TITULO_MOZO = "<?php echo Configure::read('Mesa.tituloMozo') ?>";
        
        
            // intervalo en milisegundos en el que seran renovadas las mesas
            Risto.MESAS_RELOAD_INTERVAL = <?php echo Configure::read('Adicion.reload_interval') ?>;
            Risto.MESAS_COBRADA_HIDE_MS = <?php echo Configure::read('Adicion.cobrada_hide_ms') ?>;
            //        Risto.MESA_RELOAD_TIMEOUT = <?php echo Configure::read('Adicion.reload_interval_timeout') ?>;
        
            Risto.VALOR_POR_CUBIERTO = <?php
$valorCubierto = Configure::read('Restaurante.valorCubierto');
echo $valorCubierto > 0 ? $valorCubierto : 0;
?>;
        
    // hace que luego de cobrar una mesa, esta quede activa durante X segundos
    //        Risto.ESPERAR_DESPUES_DE_COBRAR = 0;
        
        
    Risto.IMPRIME_REMITO_PRIMERO = <?php echo Configure::read('Mesa.imprimePrimeroRemito') ? 1 : 0 ?>;

    //Parametros de configuracion
    Risto.cubiertosObligatorios   = <?php echo Configure::read('Adicion.cantidadCubiertosObligatorio') ? 'true' : 'false' ?>;
        
        
    // Los botones que tengan el atributo data-href sirven para los dialogs
    // la idea es que al ser apretados el dialog se cierre, pero que se envie 
    // el href via ajax, Es util para las ocasiones en las que quiero mandar
    // una accion al servidor del cual no espero respuesta. Por ejemplo en una 
    // edicion rapida  
    $(document).on('click','[data-href]',function(e){
        var att = $(this).attr('data-href');
        if (att) {
            $.get( att );
        }
        $('.ui-dialog').dialog('close');
    });  
                                        
                                        
    function formToObject($form){
        var rta = $form.serializeArray(), 
        newObj = {}; // json modelo, para crear la mesa
        for (var r in rta ) {
            newObj[rta[r].name] = rta[r].value;
        }
        return newObj;
    }
    -->
</script>