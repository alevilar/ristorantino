<?php
/* SVN FILE: $Id: default.ctp 7690 2008-10-02 04:56:53Z nate $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 * 								1785 E. Sahara Avenue, Suite 490-204
 * 								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.console.libs.templates.skel.views.layouts
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 7690 $
 * @modifiedby		$LastChangedBy: nate $
 * @lastmodified	$Date: 2008-10-02 00:56:53 -0400 (Thu, 02 Oct 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>  
        <?php echo $html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
            echo $html->meta('icon');

            echo $html->css('ristorantino.generic');
            echo $html->css('cake.generic.croogo');
            echo $html->css('fluid_grid');
            echo $html->css('jquery-ui/pepper-grinder/jquery-ui-1.8.16.custom');
            
            $cssUserRole = "acl-".$session->read('Auth.User.role');
            if (is_file(APP.WEBROOT_DIR.DS."css".DS.$cssUserRole.".css")) {
                echo $html->css($cssUserRole,'stylesheet', array('media'=>'screen'));
            }


//            echo $javascript->link('prototype');
//            echo $javascript->link('scriptaculous');
            echo $javascript->link('jquery/jquery-1.6.4.min');
            echo $javascript->link('jquery/jquery-ui-1.8.16.custom.min');
            
            //echo $javascript->link('Controls'); // PAD numerico
        ?>
            <script type="text/javascript">
                jQuery.noConflict();
            </script>
        
        <?php
            echo $scripts_for_layout;
        ?>
        </head>
        <body>
            <div id="container" class="container_12">
            
                <div id="nav" class="grid_10">
                    <?php echo $html->link("Inicio", '/pages/home', array('class' => 'inicio')) ?>
                    <?php echo $this->element('menu_' . $this->params['controller']); ?>
                </div>
                <div class="box_user_login grid_2">
                        <?php  
                        echo $session->read('Auth.User.nombre') . " " . $session->read('Auth.User.apellido');

                        echo " - ".$session->read('Auth.User.role') ." -";
                        ?>
                    <?php echo $html->link('salir', array('controller' => 'users', 'action' => 'logout', 'plugin' => null)); ?>
                </div>
                
                <div class="clear"></div>
                <hr />
                
                <div class="grid_12">
                     <div id="mesajes"><?php $session->flash(); $session->flash('auth'); ?></div>
                </div>
                <div class="clear"></div>
                        
            
                <div id="content" class="grid_12">
                    <?php echo $content_for_layout; ?>
                </div>
                <div class="clear"></div>
            
                
                <hr />
                <div id="footer" class="container_12">
                    <div class="grid_12">
                        <?php echo $cakeDebug; ?>

                        <div class="logo">
                            <h1><?php echo Configure::read('System.name'). ' '. Configure::read('System.version')?></h1>                    
                        </div>
                    </div>
                </div>
                <div class="clear"></div>

            </div>
            
    </body>
</html>
