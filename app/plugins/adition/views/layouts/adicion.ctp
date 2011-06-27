<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');

		
		// para los modal window
		echo $html->css(array(
                    'fluid_grid',
                    'ristorantino',
                    'adicion_buttons',
                    'jquery-ui/blitzer/jquery-ui-1.8.12.custom',
                    ));
	//	echo $html->css('windowthemes/ligthing');

                $cssUserRole = "acl-".$session->read('Auth.User.role');
                if (is_file(APP.WEBROOT_DIR.DS."css".DS.$cssUserRole.".css")) {
                    echo $html->css($cssUserRole,'stylesheet', array('media'=>'screen'));
                }

                
		echo $javascript->link(array(
                    'jquery/jquery-1.5.1.min',
                    'jquery/jquery-ui-1.8.12.custom.min',
                    'jquery/jquery.tmpl.min',
                    'jquery/jquery.history',
                    'ristorantino/generic',
                    '/adition/js/adicion.class',
                    'ristorantino/mesa.class',
                    'ristorantino/mozo.class',

//                    'ristorantino/mensaje.class',
//
//                    'ristorantino/categorias.class',
//                    'ristorantino/producto.class',
                    //'ristorantino/fabrica_mozo.class',
                    //'ristorantino/fabrica_mesas.class',
                    
                    
//                    'ristorantino/cliente.class',
//                    'ristorantino/comanda.class',
//                    'ristorantino/comanda_sacar.class',
//                    'ristorantino/comanda_cocina.class',
                    
                   // 'ristorantino/ventanas',
                    
                    '/adition/js/adition.events',
//                    'adicionar/producto_comanda.class',

                    'jquery.pagesman',
                    ));




                ?>

    <script type="text/javascript">
    <!--
        // Inicializacion de variables y objetos Core
        var urlDomain = "<?php echo $html->url('/',true);?>";

        // instancio el objeto adicion que sera el kernel de la app
        var adicion = new Adicion();

        //adicion.setMozos(<?php echo json_encode($mozos)?>);
        adicion.getMesasAbiertas();
    -->
    </script>

<?php
    // Registro de botones a utilizar
    echo $javascript->link(array(
        'buttons/refresh',
        'buttons/back',
        'buttons/abrir_mesa',
        'buttons/seleccionar_mesa',
        'buttons/mesas_index',
        ));

    //scripts de Cake
    echo $scripts_for_layout;
?>
	
</head>
<body>

    <div class="mega_controlls">
        <?php echo $html->link('SALIR','/pages/home')?>
    </div>

    <div id="pages" class="container_12">
            <?php echo $content_for_layout; ?>
    </div>


    <div class="clear"></div>
<?php echo $javascript->link('adicionar/tail'); ?>
	
</body>
</html>