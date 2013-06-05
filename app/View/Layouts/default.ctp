<!DOCTYPE html> 
<html lang="es">
    <head>

        <?php echo $this->Html->charset(); ?>

        <title> <?php echo $title_for_layout; ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
         //   'jquery-mobile/jquery.mobile-1.2.0',
         //   'coqus_admin',
            '/bootstrap/css/bootstrap.min',
        ));

        $cssUserRole = "acl-" . $this->Session->read('Auth.User.role');
        if (is_file(APP . WEBROOT_DIR . DS . "css" . DS . $cssUserRole . ".css")) {
            echo $this->Html->css($cssUserRole, 'stylesheet', array('media' => 'screen'));
        }

        echo $this->Html->script(array(
            '/jquery/jquery-2.0.0',
          //  'jquery/jquery.tmpl.min',
            '/bootstrap/js/bootstrap.min.js',
//                'jquery/jquery.mobile-1.2.0',
        ));
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        //scripts de Cake
        echo $scripts_for_layout;
        ?>

    </head>

    <body>
        <div class="container"> 

            <div data-role="header">
                <h1><?php echo $title_for_layout; ?></h1>
            </div> 
            
            <div data-role="content">
                <?php $withmenuclassname = 'with-menu'; ?>
                <?php if ($this->fetch('menu')): ?>
                <?php $withmenuclassname = 'without-menu'; ?>
                <nav>
                    <?php echo $this->fetch('menu'); ?>
                </nav>
                <?php endif; ?>
                

                <div id="maincontent" class="<?php echo $withmenuclassname ?>">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->Session->flash('Auth'); ?>

                    <?php echo $this->fetch('content'); ?>

                </div>
            </div>
        </div> 



    </body>


</html>