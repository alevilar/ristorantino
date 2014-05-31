<!DOCTYPE html>
<html>
    <head>
        <script>
        var urlDomain = "<?php echo $this->Html->url('/', true); ?>";
        </script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            '/lib/bootstrap/css/bootstrap.min',
            '/lib/bootstrap/css/bootstrap-theme.min',
//            'ristorantino.generic',
            '/lib/bootstrap_datetimepicker/css/bootstrap-datetimepicker.min',
        ));

        $cssUserRole = "acl-" . $this->Session->read('Auth.User.role');
        if (is_file(APP . WEBROOT_DIR . DS . "css" . DS . $cssUserRole . ".css")) {
            echo $this->Html->css($cssUserRole, 'stylesheet', array('media' => 'screen'));
        }
        
        echo $this->Html->script(array(
            'jquery-2.0.0.min',
            '/lib/bootstrap/js/bootstrap.min',
            '/lib/bootstrap_datetimepicker/js/bootstrap-datetimepicker.min',
        ));

        //echo $this->Html->script->link('Controls'); // PAD numerico
        
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
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
                    echo $this->Session->read('Auth.User.nombre') . " " . $this->Session->read('Auth.User.apellido');

                    echo " - " . $this->Session->read('Auth.User.role') . " -";
                    ?>
                    <?php echo $this->Html->link('salir', array('controller' => 'users', 'action' => 'logout', 'plugin' => null)); ?>
                </div>

                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php echo $this->Html->link(Configure::read('Restaurante.name'), '/pages/home', array('class' => 'navbar-brand')) ?>
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
                    echo $this->Session->flash();
                    echo $this->Session->flash('auth');
                    ?>
                </div>
            </div>
            
            <div class="row">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="logo">
                    <h1><?php echo Configure::read('System.name') . ' ' . Configure::read('System.version') ?></h1>
                </div>

                <div class="col-md-12">
                    <?php echo $this->element('sql_dump'); ?>
                </div>
            </div>
        </footer>
    </body>
</html>
