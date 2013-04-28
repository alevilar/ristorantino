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
//                    '/adition/css/jquery-mobile-custom/jquery.mobile-custom',
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
        <?php echo $this->fetch('content'); ?>
    </body>
<?php
        echo $this->Html->script(array(
            'json2',
            '/jquery/jquery-2.0.0.min',
            'handlebars',
            'underscore',
            'backbone',
            '/adition/js/Risto',
            '/adition/js/Model/MesaModel',
            '/adition/js/Collection/MesasCollection',
            '/jquery/jquery.mobile/1.3.1/jquery.mobile-1.3.1',
//                       'alekeyboard',
        ));
        
        echo $this->element('js_init');
        
        //scripts de Cake
        echo $this->fetch('script');
        
         echo $this->fetch('jquery-tmpl'); 
         
         echo $this->Html->script(array(
             '/adition/js/Router/RistoRouter',
         ));
         
         ?>
</html>