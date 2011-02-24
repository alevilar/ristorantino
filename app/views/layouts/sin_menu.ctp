<?php
/* SVN FILE: $Id: default.ctp 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <?php echo $html->charset(); ?>
        <title>
                <?php __('Sistema Gestión de Registro - ');
                          echo Configure::read('regetpVersion')." - "; ?>
                <?php echo $title_for_layout; ?>
        </title>
        <?php
                echo $html->meta('icon');
                echo $html->css('cake');
                echo $html->css('printer','stylesheet', array('media'=>'print'));

                echo $javascript->link('prototype');
                echo $javascript->link('mensaje.class');
                echo $javascript->link('ejecutar_en_head');
                //echo $javascript->link('form_regetp_ria');
                echo $scripts_for_layout;
        ?>

</head>
<body>
        <script type="text/javascript">
                var mensajero = new Mensaje('mensajero');
        </script>

        <? if ($_SERVER['HTTP_HOST']=='localhost'){?>
                <div style="background-color: red; height: 20px; text-align: center">MODO LOCALHOST</div>
        <? }?>

        <div>
                <!-- DIV del mensajero, aca se van a mostrar mensajes AJAX, JS, etc -->
                <div id="mensajero" style="display: none"></div>


                <div id="header" >
                        <h1>El Ristorantino Mágico - versión 11.01.11</h1>
			<div id="mesajes"><?php $session->flash(); ?></div>
			<?php echo $html->link("Inicio",'/pages/home',array('class'=>'inicio'))?>
                </div>
                
                <div  id="content">
                        <div>
                                <?php $session->flash(); ?>
                                <? $session->flash('auth'); ?>
                                <?php echo $content_for_layout;?>
                        </div>
                </div>
                <div id="footer">
                        <?php echo $html->link(
                                        $html->image('cake.power.gif', array('alt'=> __("CakePHP: the rapid development php framework", true), 'border'=>"0")),
                                        'http://www.cakephp.org/',
                                        array('target'=>'_blank'), null, false
                                );
                        ?>
                </div>
        </div>
        <?php echo $cakeDebug; ?>
</body>
</html>

