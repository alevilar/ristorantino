<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <script type="text/javascript">
        <!--
            // Inicializacion de variable global de url
            var urlDomain = "<?php echo $this->Html->url('/',true);?>";
        -->
        </script>
    
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
    
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
    
        <base href="<?= $this->Html->url('/')?>" />
            <?php
		echo $this->Html->meta('icon');
		
		// para los modal window
		echo $this->Html->css(array(
                    'jquery-mobile/jquery.mobile-1.2.0',
//                    'jquery-mobile/jquerymobile.coqus',
//                    'jquery-mobile/jquery.mobile.actionsheet',
                    '/adition/css/ristorantino',
                    '/adition/css/jquery-mobile-custom/jquery.mobile-custom',
                    'keyboard',
                    'alekeyboard',
                    ));

                $cssUserRole = "acl-".$this->Session->read('Auth.User.role');
                if (is_file(APP.WEBROOT_DIR.DS."css".DS.$cssUserRole.".css")) {
                    echo $this->Html->css($cssUserRole,'stylesheet', array('media'=>'screen'));
                }
                
               
                $debug = Configure::read('debug');
                if ( $debug > 0 ) {
                    echo $this->Html->script( array(
                        'jquery/jquery-1.8.1',
                        'jquery/jquery.tmpl.min',

                        'knockout-2.1.0.min',
//                        'knockout-1.2.1.debug',
                        'knockout.mapping-2.0.debug',

                        '/adition/js/cake_saver',
                        '/adition/js/risto',

    //                    'knockout.updateData',

                        // OJO !! EL ORDEN IMPORTA !!
                        
                        '/adition/js/adicion/adition.package',
                        '/adition/js/cliente/descuento.class',
                        '/adition/js/mozo/mozo.class',
                        '/adition/js/adicion/handle_mesas_recibidas',
                        '/adition/js/adicion/event_handler',
                        '/adition/js/mesa/estados.class',                        
                        '/adition/js/mesa/mesa.class',
                        '/adition/js/comanda/comanda.class',
                        '/adition/js/comanda/fabrica.class',
                        '/adition/js/adicion/adicion.class', // depende de Mozo, Mesa y Comanda
                        '/adition/js/menu/producto',
                        '/adition/js/menu/categoria',
                        '/adition/js/menu/sabor.class',
                        '/adition/js/cliente/cliente.class',                        
                        '/adition/js/mesa/pago.class',
                        '/adition/js/comanda/detalle_comanda.class',
                        '/adition/js/ko_adicion_model',
                        '/adition/js/adicion/events',
                        '/adition/js/menu/menu',
    //                    'http://code.jquery.com/mobile/latest/jquery.mobile.min.js',
                        'jquery/jquery.mobile-1.2.0',
                       'alekeyboard',
                        ));
                } else {
                    echo $this->Html->script('todos.min');
                }
            ?>
<?php
    //scripts de Cake
    echo $scripts_for_layout;
    
    echo $this->element('js_init');
?>

</head>

<body>
	<?php echo $content_for_layout; ?>
</body>
</html>