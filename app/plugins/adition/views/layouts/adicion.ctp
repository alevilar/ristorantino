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
    
        <base href="<?= $html->url('/')?>" />
        

        
	<?php
		echo $html->meta('icon');
		
		// para los modal window
		echo $html->css(array(
//                    'http://code.jquery.com/mobile/latest/jquery.mobile.min.css',
                    'jquery-mobile/jquery.mobile.min',
//                    'jquery-mobile/jquery.mobile-1.0rc1.min',
//                    'jquery-mobile/jquery-mobile-fluid960',
                    'jquery-mobile/jquery.mobile.actionsheet',
                    '/adition/css/ristorantino',
                    'jquery-mobile/jquery.mobile-custom',
                    ));

                $cssUserRole = "acl-".$session->read('Auth.User.role');
                if (is_file(APP.WEBROOT_DIR.DS."css".DS.$cssUserRole.".css")) {
                    echo $html->css($cssUserRole,'stylesheet', array('media'=>'screen'));
                }
                
//                echo $javascript->link('todos');


                /*
                 * 
                 * ESTO SOLO PARA DESARROLLO, el de arriba va a produccion
                 */
		echo $javascript->link( array(
                    '/adition/js/cake_saver',
                    'risto/risto',
//                    'http://code.jquery.com/jquery-1.6.2.min.js',
                    'jquery/jquery-1.6.4.min',
                    'jquery/jquery.tmpl.min',
//                    'jquery/jquery.periodicalupdater',
                    
//                    'jquery/fg.menu',
                    'ristorantino/generic',
                    
                    'knockout-1.2.1',
                    'knockout.mapping',
                    
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
                    'jquery/jquery.mobile-1.0rc1.min',
//                    'jquery/jquery.easing.1.3',
//                    'jquery/jquery.mobile.actionsheet',
//                    'jquery/jquery.mobile.scrollview.js',
                   
                    ));
                
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
                  $.mobile.defaultPageTransition = 'none';
                });
//                $.mobile.page.prototype.options.defaultPageTransition = "none";
        <?php }} ?>
        
        
        
        // intervalo en milisegundos en el que seran renovadas las mesas
        MESAS_RELOAD_INTERVAL = <?php echo Configure::read('Adicion.reload_interval')?>;
        MESA_RELOAD_TIMEOUT = <?php echo Configure::read('Adicion.reload_interval_timeout')?>;

        //Parametros de configuracion
        Risto.Adition.cubiertosObligatorios   = <?php echo Configure::read('Adicion.cantidadCubiertosObligatorio')?'true':'false'?>;


        // instancio el objeto adicion que sera el kernel de la app
        Risto.Adition.adicionar.initialize();
        
    -->
    </script>

<?php
    //scripts de Cake
    echo $scripts_for_layout;
?>
</head>

<body>
	<?php echo $content_for_layout; ?>
</body>
</html>