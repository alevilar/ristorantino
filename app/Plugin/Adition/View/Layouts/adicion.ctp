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


        <base href="<?= $this->Html->url('/') ?>" />
        <?php
        echo $this->Html->meta('icon');

        // para los modal window
        echo $this->Html->css(array(
            '/jquery/jquery.mobile/1.2.1/jquery.mobile-1.2.1',
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


        echo $this->Html->script(array(
            '/jquery/jquery-1.8.3.min',
            'jquery/jquery.tmpl.min',
            'knockout/knockout-2.2.1.min',
            'knockout/knockout.mapping-2.4.1',
            
            '/adition/js/risto',
            '/adition/js/cake_saver',
            //                    'knockout.updateData',
            // OJO !! EL ORDEN IMPORTA !!

            
            '/adition/js/mozo/mozo.class',
            '/adition/js/adicion/handle_mesas_recibidas',
            '/adition/js/adicion/event_handler',
            '/adition/js/mesa/mesa.class',
            '/adition/js/mesa/estados.class',
            
            '/adition/js/comanda/comanda.class',
            '/adition/js/comanda/fabrica.class',
            '/adition/js/menu/menu',
            '/adition/js/menu/producto',
            '/adition/js/menu/categoria',
            '/adition/js/menu/sabor.class',
            '/adition/js/cliente/cliente.class',
            '/adition/js/mesa/descuento.class',
            '/adition/js/mesa/pago.class',
            '/adition/js/comanda/detalle_comanda.class',
            '/adition/js/adicion/events',
            
            '/adition/js/adicion/key_events',
            '/jquery/jquery.mobile/1.2.1/jquery.mobile-1.2.1',
//                       'alekeyboard',
        ));


        //scripts de Cake
        echo $this->fetch('script');
        echo $this->element('js_init');
        ?>
    </head>
    <body>
        <?php echo $this->fetch('jquery-tmpl'); ?>
        <?php echo $this->fetch('content'); ?>
    </body>
</html>