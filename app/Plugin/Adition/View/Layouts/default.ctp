<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
    <head>
        <script type="text/javascript">
            <!--
            // Inicializacion de variable global de url
            var urlDomain = "<?php echo $this->Html->url('/', true); ?>";
            
            // ir siempre a la HOME
            if (window.location.hash && window.location.hash != '#listado-mesas') {
                window.location.replace('<?php echo $this->Html->url('/adition'); ?>');
            }

            -->
        </script>

        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>


        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;"> 
        <meta name="apple-mobile-web-app-capable" content="yes">


        <base href="<?= $this->Html->url('/') ?>" />
        <?php
        echo $this->Html->meta('icon');

        // para los modal window
        echo $this->Html->css(array(
            '/jquery/jquery.mobile/1.3.1/jquery.mobile-1.3.1',
//                    'jquery-mobile/jquerymobile.coqus',
//                    'jquery-mobile/jquery.mobile.actionsheet',
            '/adition/css/ristorantino',
                    '/adition/css/jquery-mobile-custom/ristorantino',
//                    'keyboard',
//                    'alekeyboard',
        ));

        $cssUserRole = "acl-" . $this->Session->read('Auth.User.role');
        if (is_file(APP . WEBROOT_DIR . DS . "css" . DS . $cssUserRole . ".css")) {
            echo $this->Html->css($cssUserRole, 'stylesheet', array('media' => 'screen'));
        }


        ?>
        
    </head>
    <body>
    	<div id="main-region"></div>
    	
        <?php echo $this->fetch('content'); ?>
    	
<?php
        echo $this->Html->script(array(
        	// Marionettejs
            '/adition/js/vendors/backbone.marionette/json2',
            '/jquery/jquery-2.0.0.min',
            'handlebars',
            '/adition/js/vendors/backbone.marionette/underscore',
            '/adition/js/vendors/backbone.marionette/backbone',
            '/adition/js/vendors/backbone.marionette/backbone.babysitter',
            '/adition/js/vendors/backbone.marionette/backbone.wreqr',
            '/adition/js/vendors/backbone.marionette/backbone.marionette',
            //'https://raw.github.com/marionettejs/backbone.marionette/master/lib/backbone.marionette.js',
            
			//backbone relational
			'/adition/js/vendors/backbone-relational',
			
			
			// APP main
            '/adition/js/App/app',
            '/adition/js/App/appController',
            '/adition/js/App/router',
            
			// App/Mesas module
			'/adition/js/App/Mesa/mesaApp',
            '/adition/js/App/Mesa/Model/Mesa',
            '/adition/js/App/Mesa/Collection/Mesas',
            '/adition/js/App/Mesa/Model/Mozo',
            '/adition/js/App/Mesa/Collection/Mozos',
            '/adition/js/App/Mesa/View/MozoView',
            '/adition/js/App/Mesa/View/MozosView',            
			'/adition/js/App/Mesa/View/MiniMesaView',
            '/adition/js/App/Mesa/View/AppLayout',


            //jQuery.Mobile
			'/adition/js/jqm_events/listado_mesas',
            '/jquery/jquery.mobile/1.3.1/jquery.mobile-1.3.1',
            
             
//                       'alekeyboard',
        ));
        
        echo $this->element('js_init');
        
        //scripts de Cake
        echo $this->fetch('script');
        
         echo $this->fetch('jquery-tmpl'); 
         
         echo $this->Html->script(array(
             
         ));
         
         ?>
         <script>
         	App.start();
         </script>
        </body>
</html>