<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
                    '/adition/css/ristorantino'
                    ));

                $cssUserRole = "acl-".$session->read('Auth.User.role');
                if (is_file(APP.WEBROOT_DIR.DS."css".DS.$cssUserRole.".css")) {
                    echo $html->css($cssUserRole,'stylesheet', array('media'=>'screen'));
                }

		echo $javascript->link(array(
                    'risto/risto',
                    'jquery/jquery-1.6.1.min',
                    'jquery/jquery.tmpl.min',
                    'jquery/jquery.periodicalupdater',
                     'jquery/jquery.mobile-1.0b2',
                    'jquery/jquery.easing.1.3',
                    'knockout-1.2.1',
                    'knockout.mapping',
                    
//                    'jquery/jquery.mobile.splitview',

//                    'jquery/jquery.mobile.scrollview',
//                    'jquery/scrollview',
                    
                    'jquery/fg.menu',

                    'ristorantino/generic',
                    '/adition/js/adicion.class',
                    'risto/mesa.class',
                    'risto/mozo.class',

                     
                    '/adition/js/adition.events',
                    '/adition/js/comanda',
                    '/adition/js/categoria',
                    '/adition/js/producto',

                   
                    ));
                ?>

    <script type="text/javascript">
    <!--
        $.mobile.page.prototype.options.backBtnText = "Volver";

        // Inicializacion de variables y objetos Core
        var urlDomain = "<?php echo $html->url('/',true);?>";

        // instancio el objeto adicion que sera el kernel de la app
        var adicion = new Adicion();
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