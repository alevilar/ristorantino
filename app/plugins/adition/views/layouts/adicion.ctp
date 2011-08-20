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
                    'jquery-mobile/jquery.mobile-1.0b2.min',
                    'jquery-mobile/jquery-mobile-fluid960',
                    'jquery-mobile/jquery.mobile.actionsheet',
                    '/adition/css/ristorantino'
                    ));

                $cssUserRole = "acl-".$session->read('Auth.User.role');
                if (is_file(APP.WEBROOT_DIR.DS."css".DS.$cssUserRole.".css")) {
                    echo $html->css($cssUserRole,'stylesheet', array('media'=>'screen'));
                }

		echo $javascript->link( array(
                    '/adition/js/cake_saver',
                    'risto/risto',
                    'jquery/jquery-1.6.1.min',
                    'jquery/jquery.tmpl.min',
                    'jquery/jquery.periodicalupdater',
                    
                    'jquery/fg.menu',
                    'ristorantino/generic',
                    
                    'knockout-1.2.1',
                    'knockout.mapping',
                    
                    // OJO !! EL ORDEN IMPORTA !!
                    '/adition/js/adition.package',
                    'risto/mozo.class',
                    'risto/mesa.class',
                    '/adition/js/comanda.class',
                    '/adition/js/comanda_fabrica.class',
                    '/adition/js/adicion.class',
                    
                    '/adition/js/producto',
                    '/adition/js/categoria',
                    '/adition/js/sabor.class',
                    
                    
                    '/adition/js/detalle_comanda.class',
                    
                    
                    '/adition/js/ko_adicion_model',
                    '/adition/js/adition.events',
                   '/adition/js/menu',
                    
                    
                    
                    
                     'jquery/jquery.mobile-1.0b2',
                    'jquery/jquery.easing.1.3',
                    'jquery/jquery.mobile.actionsheet',
                   
                    ));
                ?>

    <script type="text/javascript">
    <!--
        $.mobile.page.prototype.options.backBtnText = "Volver";

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