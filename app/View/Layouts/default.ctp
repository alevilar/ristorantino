<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
        <?php
            echo $this->Html->meta('icon');

            echo $this->Html->css('ristorantino.generic');
            echo $this->Html->css('cake.generic.croogo');
            echo $this->Html->css('fluid_grid');
            echo $this->Html->css('jquery-ui/pepper-grinder/jquery-ui-1.8.16.custom');
            
            $cssUserRole = "acl-".$this->Session->read('Auth.User.role');
            if ( is_file(APP.WEBROOT_DIR.DS."css".DS.$cssUserRole.".css") ) {
                echo $this->Html->css($cssUserRole,'stylesheet', array('media'=>'screen'));
            }


//            echo $javascript->link('prototype');
//            echo $javascript->link('scriptaculous');
            echo $this->Html->script('jquery/jquery-1.6.4.min');
            echo $this->Html->script('jquery/jquery-ui-1.8.16.custom.min');
            
            //echo $javascript->link('Controls'); // PAD numerico
        ?>
            <script type="text/javascript">
                jQuery.noConflict();
            </script>
        
        <?php
            echo $scripts_for_layout;
            
            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
        ?>
        </head>
        <body>
            <div id="container" class="container_12">
            
                <div id="nav" class="grid_10">
                    <?php echo $this->Html->link("Inicio", '/pages/home', array('class' => 'inicio')) ?>
                    <?php echo $this->element('menu_' . $this->params['controller']); ?>
                </div>
                <div class="box_user_login grid_2">
                        <?php  
                        echo $this->Session->read('Auth.User.nombre') . " " . $this->Session->read('Auth.User.apellido');

                        echo " - ".$this->Session->read('Auth.User.rol') ." -";
                        ?>
                    <?php echo $this->Html->link('salir', array('controller' => 'users', 'action' => 'logout', 'plugin' => null)); ?>
                </div>
                
                <div class="clear"></div>
                <hr />
                
                <div class="grid_12">
                     <div id="mesajes"><?php echo $this->Session->flash(); echo $this->Session->flash('auth'); ?></div>
                </div>
                <div class="clear"></div>
                        
            
                <div id="content" class="grid_12">
                    <?php echo $this->fetch('content'); ?>
                </div>
                <div class="clear"></div>
            
                
                <hr />
                <div id="footer" class="container_12">
                    <div class="grid_12">
                        <?php echo $this->element('sql_dump'); ?>
                        <div class="logo">
                            <h1><?php echo Configure::read('System.name'). ' '. Configure::read('System.version')?></h1>                    
                        </div>
                    </div>
                </div>
                <div class="clear"></div>

            </div>
            
    </body>
</html>
