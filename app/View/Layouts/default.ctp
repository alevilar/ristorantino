<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <?php echo $this->Html->charset(); ?>

        <title> <?php echo $title_for_layout; ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            'jquery-mobile/jquery.mobile-1.2.0',
            'coqus_admin',
        ));

        $cssUserRole = "acl-" . $this->Session->read('Auth.User.role');
        if (is_file(APP . WEBROOT_DIR . DS . "css" . DS . $cssUserRole . ".css")) {
            echo $this->Html->css($cssUserRole, 'stylesheet', array('media' => 'screen'));
        }


        $debug = Configure::read('debug');
        if ($debug > 0) {
            echo $this->Html->script(array(
                'jquery/jquery-1.8.1',
                'jquery/jquery.tmpl.min',
//                'jquery/jquery.mobile-1.2.0',
            ));
        } else {
            echo $this->Html->script('todos_default.min');
        }

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        //scripts de Cake
        echo $scripts_for_layout;
        ?>

    </head>

    <body>

        <div data-role="page" data-add-back-btn="true"> 

            <div data-role="header">
                <h1><?php echo $title_for_layout; ?></h1>
            </div> 
            <div data-role="content">
                <nav>
                    <?php echo $this->element('admin_menu'); ?>
                </nav>

                <div id="maincontent">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->Session->flash('Auth'); ?>

                    <?php echo $this->fetch('content'); ?>

                </div>

                <?php echo $this->element('sql_dump'); ?>
            </div>
        </div> 



    </body>


</html>