<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
        <script type="text/javascript">
        <!--
            // Inicializacion de variable global de url
            var urlDomain = "<?php echo $html->url('/',true);?>";
        -->
        </script>
    
	<?php echo $html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
    
        <base href="<?= $html->url('/')?>" />
            <?php
		echo $html->meta('icon');
		
		// para los modal window
		echo $html->css(array(
//                    'http://code.jquery.com/mobile/latest/jquery.mobile.min.css',
                    'jquery-mobile/jquery.mobile-1.0rc2',
//                    'jquery-mobile/jquery.mobile-1.0rc1.min',
//                    'jquery-mobile/jquery-mobile-fluid960',
                    'jquery-mobile/jquery.mobile.actionsheet',
                    '/adition/css/ristorantino',
                    'jquery-mobile/jquery.mobile-custom',
                    'keyboard',
                    'alekeyboard',
                    ));

                $cssUserRole = "acl-".$session->read('Auth.User.role');
                if (is_file(APP.WEBROOT_DIR.DS."css".DS.$cssUserRole.".css")) {
                    echo $html->css($cssUserRole,'stylesheet', array('media'=>'screen'));
                }
                
               
                $debug = Configure::read('debug');
                if ( $debug > 0 ) {
                    echo $javascript->link( array(
                        'jquery/jquery-1.6.4',
                        'jquery/jquery.tmpl.min',

                        'knockout-1.2.1.debug',
                        'knockout.mapping-2.0.debug',

                        '/adition/js/cake_saver',
                        '/adition/js/risto',

    //                    'knockout.updateData',

                        // OJO !! EL ORDEN IMPORTA !!
                        '/adition/js/adition.package',
                        '/adition/js/mozo.class',
                        '/adition/js/mesa.estados.class',
                        '/adition/js/mesa.class',
                        '/adition/js/comanda.class',
                        '/adition/js/comanda_fabrica.class',
                        '/adition/js/adicion.class', // depende de Mozo, Mesa y Comanda
                        '/adition/js/producto',
                        '/adition/js/categoria',
                        '/adition/js/sabor.class',
                        '/adition/js/cliente.class',
                        '/adition/js/descuento.class',
                        '/adition/js/pago.class',
                        '/adition/js/detalle_comanda.class',
                        '/adition/js/ko_adicion_model',
                        '/adition/js/adition.events',
                        '/adition/js/menu',
    //                    'http://code.jquery.com/mobile/latest/jquery.mobile.min.js',
                        'jquery/jquery.mobile-1.0rc2',
                       'alekeyboard',
                        ));
                } else {
                    echo $javascript->link('todos.min');
                }

 
            ?>
<?php
    //scripts de Cake
    echo $scripts_for_layout;
?>
        
    <script type="text/javascript">
    <!--
        $(document).bind("mobileinit", function(){
          $.extend(  $.mobile , {
            backBtnText: "Volver"
          });
        });
        
        <?php 
        $animar = Configure::read('Adicion.jqm_page_transition');
        if (!empty($animar)){ 
            if (!$animar) {
            ?>
                $(document).bind("mobileinit", function(){
                  $.extend(  $.mobile , {
                    defaultPageTransition: 'none'
                  });
                });
        <?php }} ?>
        
        
        
        // intervalo en milisegundos en el que seran renovadas las mesas
        MESAS_RELOAD_INTERVAL = <?php echo Configure::read('Adicion.reload_interval')?>;
        MESA_RELOAD_TIMEOUT = <?php echo Configure::read('Adicion.reload_interval_timeout')?>;
        
        VALOR_POR_CUBIERTO = <?php echo Configure::read('Restaurante.valorCubierto')?>;
        
        // hace que luego de cobrar una mesa, esta quede activa durante X segundos
        ESPERAR_DESPUES_DE_COBRAR = 0;
        
        
        IMPRIME_REMITO_PRIMERO = <?php echo Configure::read('Mesa.imprimePrimeroRemito')?1:0?>;

        //Parametros de configuracion
        Risto.Adition.cubiertosObligatorios   = <?php echo Configure::read('Adicion.cantidadCubiertosObligatorio')?'true':'false'?>;


        // instancio el objeto adicion que sera el kernel de la app
        Risto.Adition.adicionar.initialize();
        
    -->
    </script>


</head>

<body>
	<?php echo $content_for_layout; ?>
</body>
</html>