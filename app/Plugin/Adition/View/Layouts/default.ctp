<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
    <head>
        <script type="text/javascript">
            <!--
            // Inicializacion de variable global de url
            var urlDomain = "<?php echo $this->Html->url('/', true); ?>";                    

            -->
        </script>

        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>


        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;"> 
            <meta name="apple-mobile-web-app-capable" content="yes">


                <?php
                echo $this->Html->meta('icon');

                // para los modal window
                echo $this->Html->css(array(
                    //    '/jquery/jquery.mobile/1.3.1/jquery.mobile-1.3.1',
//                    'jquery-mobile/jquerymobile.coqus',
//                    'jquery-mobile/jquery.mobile.actionsheet',
                    '/bootstrap/css/bootstrap',
                    '/bootstrap/css/bootstrap-responsive',
                    '/font-awesome/css/font-awesome',
                    '/adition/bootstrap-editable/css/bootstrap-editable',
                    '/adition/css/style',
                    '/adition/css/tree',
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
                <body id="app-body">
                    <div id="body-container"></div>
                    <div id="dialog" role="dialog" class="modal hide fade"></div>
                    <div id="big-dialog" role="dialog" class="modal hide big-modal"></div>


<?php
echo $this->fetch('content');

echo $this->Html->script(array(
    // Marionettejs
    '/adition/js/vendors/backbone.marionette/json2',
//            '/jquery/jquery-2.0.0.min',
    '/jquery/jquery-1.9.1.min',
    'handlebars',
    '/adition/js/vendors/backbone.marionette/underscore',
    '/adition/js/vendors/backbone.marionette/backbone',
    '/adition/js/vendors/backbone.marionette/backbone.babysitter',
    '/adition/js/vendors/backbone.marionette/backbone.wreqr',
    '/adition/js/vendors/backbone.marionette/backbone.marionette',
    //'https://raw.github.com/marionettejs/backbone.marionette/master/lib/backbone.marionette.js',
    //backbone relational
    '/adition/js/vendors/backbone-relational',
    '/bootstrap/js/bootstrap',
    '/adition/bootstrap-editable/js/bootstrap-editable',
    // APP main
    '/adition/js/App/app',
    '/adition/js/App/appController',
    // App/Mesas module
    '/adition/js/App/app.mesa',
    // App/Comandas module
    '/adition/js/App/app.comanda',
    '/adition/js/App/app.menu',
));

echo $this->element('js_init');

//scripts de Cake
echo $this->fetch('script');

echo $this->fetch('jquery-tmpl');

echo $this->Html->script(array(
    '/adition/js/main'
));
?>
                </body>
                </html>