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
<html xmlns="http://www.w3.org/1999/xhtml">
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


            echo $javascript->link('prototype');
            echo $javascript->link('scriptaculous');
            echo $javascript->link('jquery/jquery-1.6.1.min');
            echo $javascript->link('jquery/jquery-ui-1.8.14.custom.min');
            echo $scripts_for_layout;
            //echo $javascript->link('Controls'); // PAD numerico
        ?>
            <script type="text/javascript">
                jQuery.noConflict();
            </script>
        </head>
        <body>
            <div id="container" class="container_12">
                <div class="grid_12 header">
                <?php echo $html->link("Inicio", '/pages/home', array('class' => 'inicio')) ?>
                    
                <?php  
                echo($session->read('Auth.User.username'));
                 ?>
                    

                <?php echo $html->link('Cambiar de usuario', array('controller' => 'users', 'action' => 'logout', 'plugin' => null), array('style' => 'float: right; margin-top:45px; font-size: 135%;')); ?>
                <div id="mesajes"><?php $session->flash(); $session->flash('auth'); ?></div>
                </div>
                <div id="content" class="grid_12">
                    <?php echo $content_for_layout; ?>
                </div>

        </div>

        <div class="clear"></div>
        <div class="container_12">
            <?php echo $cakeDebug; ?>
        </div>

    </body>
</html>
