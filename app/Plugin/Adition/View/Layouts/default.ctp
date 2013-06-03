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
        //    '/jquery/jquery.mobile/1.3.1/jquery.mobile-1.3.1',
//                    'jquery-mobile/jquerymobile.coqus',
//                    'jquery-mobile/jquery.mobile.actionsheet',
			'/adition/bootstrap/css/bootstrap',
			'/adition/bootstrap/css/bootstrap-responsive',
            '/adition/css/style',
  //                  '/adition/css/jquery-mobile-custom/ristorantino',
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
    		
	    	<header id="main-header" class="navbar navbar-inverse">
		      <div class="navbar-inner">
		        <div class="container">
		          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <span class="brand">COQUS :: El Ristorantino Mágico</span>
		          <div class="nav-collapse collapse">
		            <ul class="nav nav-pill pull-right">	              
		              <li class="dropdown">
		                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opciones <b class="caret"></b></a>
		                <ul class="dropdown-menu">
		                  <li><a href="#">Action</a></li>
		                  <li><a href="#">Another action</a></li>
		                  <li><a href="#">Something else here</a></li>
		                  <li class="divider"></li>
		                  <li class="nav-header">Nav header</li>
		                  <li><a href="#">Separated link</a></li>
		                  <li><a href="#">One more separated link</a></li>
		                </ul>
		              </li>
		            </ul>	           
		          </div><!--/.nav-collapse -->
		        </div>
		      </div>
		    </header>
		    
    		<div id="main-container" class="container"></div>
	    	
	    	<footer id="main-footer"></footer>
	    	
	    	<div id="dialog" role="dialog" class="modal hide fade"></div>
	    	
    	
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
            '/adition/js/vendors/backbone.marionette/backbone.marionette.min',
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
            '/adition/js/App/Mesa/View/MesaView',
            '/adition/js/App/Mesa/View/MozoView',
            '/adition/js/App/Mesa/View/MozosView',
            '/adition/js/App/Mesa/View/MesaFormView',
            '/adition/js/App/Mesa/View/MesaExtraView',            
	
			'/adition/bootstrap/js/bootstrap',
            //jQuery.Mobile
		//	'/adition/js/jqm_events/listado_mesas',
      //      '/jquery/jquery.mobile/1.3.1/jquery.mobile-1.3.1',
            
             
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