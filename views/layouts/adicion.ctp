<?php
/* SVN FILE: $Id: default.ctp 7690 2008-10-02 04:56:53Z nate $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
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

		//echo $html->css('cake');
		echo $html->css('Adicion');
		
		// para los modal window
		echo $html->css('windowthemes/default');
		echo $html->css('windowthemes/alert');
		echo $html->css('windowthemes/spread');
		echo $html->css('windowthemes/ligthing');

		echo $scripts_for_layout;
		
		echo $javascript->link('prototype-1.6.0.3');		
		echo $javascript->link('scriptaculous');	
		
		
		echo $javascript->link('adicionar/head');		
		
		echo $javascript->link('ristorantino/categorias.class');
		echo $javascript->link('ristorantino/producto.class');		
		echo $javascript->link('ristorantino/fabrica_mozo.class');
		echo $javascript->link('ristorantino/fabrica_mesas.class');
		echo $javascript->link('ristorantino/mesa.class');
		echo $javascript->link('ristorantino/mozo.class');
		echo $javascript->link('ristorantino/mensaje.class');
		
		echo $javascript->link('adicionar/comanda.class');
		echo $javascript->link('adicionar/adicion.class');
		echo $javascript->link('adicionar/producto_comanda.class');		
		
		echo $javascript->link('adicionar/eventos_observados');

		
		echo $javascript->link('numpad'); // PAD numerico
		
		
		// Modal window  Prototype window by http://prototype-window.xilinus.com/index.html
		echo $javascript->link('window'); 
		
	?>
</head>
<body>
	<div id="container">
		<div id="content">
			<?php echo $content_for_layout; ?>
		</div>
	</div>
	<?php echo $javascript->link('adicionar/tail'); ?>
	<?php echo $cakeDebug; ?>
	
</body>
</html>