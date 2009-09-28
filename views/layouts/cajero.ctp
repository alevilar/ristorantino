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
		echo $html->css('Cajero');
		
		// para los modal window
		echo $html->css('windowthemes/default');
		echo $html->css('windowthemes/alert');
		
		
		echo $javascript->link('prototype');		
		echo $javascript->link('scriptaculous');	
		
		echo $javascript->link('cajero/cajero');	
		
		/*
		echo $javascript->link('adicionar/head');		
		
		echo $javascript->link('ristorantino/categorias.class');
		echo $javascript->link('ristorantino/producto.class');		
		echo $javascript->link('ristorantino/fabrica_mozo.class');
		echo $javascript->link('ristorantino/fabrica_mesas.class');
		echo $javascript->link('ristorantino/mesa.class');
		echo $javascript->link('ristorantino/mozo.class');
		echo $javascript->link('ristorantino/mensaje.class');
		echo $javascript->link('ristorantino/cliente.class');
		
		echo $javascript->link('ristorantino/comanda.class');
		echo $javascript->link('ristorantino/comanda_sacar.class');
		echo $javascript->link('ristorantino/comanda_cocina.class');
		
		echo $javascript->link('adicionar/adicion.class');
		echo $javascript->link('adicionar/producto_comanda.class');		
		
		echo $javascript->link('adicionar/eventos_observados');

		
		echo $javascript->link('numpad'); // PAD numerico
		
		*/
		
		// Modal window  Prototype window by http://prototype-window.xilinus.com/index.html
		echo $javascript->link('window');

		
			?>
</head>
<body>
	<div id="container">
		<div id="content">
			
			<div id="navegador">
				<?php echo $html->link('HOME','/pages/home',array('class'=> 'boton letra-chica'));?>
				<?php echo $html->link('Cajero','/cajero/cobrar',array('class'=> 'boton letra-chica'));?>
				<?php echo $html->link('Mesas Abiertas','/cajero/mesas_abiertas',array('class'=> 'boton letra-chica'));?>
			</div>

			<?php echo $content_for_layout; ?>
		</div>
	</div>
	<?php //echo $javascript->link('cajero/tail'); ?>
	<?php echo $cakeDebug; ?>
	
</body>
</html>