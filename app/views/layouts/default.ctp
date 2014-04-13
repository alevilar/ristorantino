<!DOCTYPE html>
<html>
    <head>
        <script>
        var urlDomain = "<?php echo $html->url('/', true); ?>";
        </script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php echo $html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $html->meta('icon');

        echo $html->css(array(
            '/lib/bootstrap/css/bootstrap.min',
            '/lib/bootstrap/css/bootstrap-theme.min',
            'ristorantino.generic',
            '/lib/bootstrap_datetimepicker/css/bootstrap-datetimepicker.min',
        ));

        $cssUserRole = "acl-" . $session->read('Auth.User.role');
        if (is_file(APP . WEBROOT_DIR . DS . "css" . DS . $cssUserRole . ".css")) {
            echo $html->css($cssUserRole, 'stylesheet', array('media' => 'screen'));
        }
        
        echo $javascript->link(array(
            'jquery/jquery-1.9.1.min',
            '/lib/bootstrap/js/bootstrap.min',
            '/lib/bootstrap_datetimepicker/js/bootstrap-datetimepicker.min',
        ));

        //echo $javascript->link('Controls'); // PAD numerico

        echo $scripts_for_layout;
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <a class="sr-only" href="#content">Skip to main content</a>

        <!-- Docs master nav -->
        <header class="navbar navbar-inverse bs-docs-nav" role="banner">


            <div class="container">

                <div class="nav navbar-right text-warning">
                    <?php
                    echo $session->read('Auth.User.nombre') . " " . $session->read('Auth.User.apellido');

                    echo " - " . $session->read('Auth.User.role') . " -";
                    ?>
                    <?php echo $html->link('salir', array('controller' => 'users', 'action' => 'logout', 'plugin' => null)); ?>
                </div>

                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php echo $html->link(Configure::read('Restaurante.name'), '/pages/home', array('class' => 'navbar-brand')) ?>
                </div>

                <?php if (!empty($elementMenu)) {
                    echo $this->element($elementMenu);
                } 
                ?>
            </div>
        </header>

        <div class="container bs-docs-container" id="content">

            <div class="row">
                <div id="mesajes" class="col-md-12">
                    <?php
                    $session->flash();
                    $session->flash('auth');
                    ?>
                </div>
            </div>

            <div class="row">
                <?php echo $content_for_layout; ?>
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="logo">
                    <h1><?php echo Configure::read('System.name') . ' ' . Configure::read('System.version') ?></h1>                    
                </div>

                <div class="col-md-12">
                    <?php echo $cakeDebug; ?>
                </div>
            </div>
        </footer>
    </body>
</html>
