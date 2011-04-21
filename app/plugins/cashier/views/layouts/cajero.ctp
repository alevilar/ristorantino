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

		echo $javascript->link('php');
		
		echo $javascript->link('/cashier/js/cajero');
		echo $javascript->link('/cashier/js/head');
		
		
		// Modal window  Prototype window by http://prototype-window.xilinus.com/index.html
		echo $javascript->link('window');

		
			?>
</head>
<body>

                
		<div id="mesajes" style="display: none">
                <?php
                    /* @var $session SessionHelper */
                    $hayMensaje = $session->flash('auth');
                    ?>
                </div>
                <?php if ($hayMensaje) { ?>
		<script type="text/javascript">
                        $('mesajes').show();
			setTimeout(function(){$('mesajes').hide()}, 3000);
		</script>
                <?php } ?>
	

	<div id="container">
		<div id="content">
			
			<div id="navegador">
				<?php echo $html->link('SALIR','/pages/home',array('class'=> 'boton letra-chica'));?>
				<?php $agrega_clase = ($this->action == 'cobrar')?' boton-apretado':''?>
				<?php echo $html->link('Cajero','cobrar',array('class'=> 'boton letra-chica '.$agrega_clase));?>
				<?php $agrega_clase = ($this->action == 'mesas_abiertas')?' boton-apretado':''?>
				<?php echo $html->link('Mesas Abiertas','mesas_abiertas',array('class'=> 'boton letra-chica '.$agrega_clase));?>
                            <?php echo $html->link('Ultimas Cobradas','ultimas_cobradas',array('class'=> 'boton letra-chica '.$agrega_clase));?>
                                <?php echo $html->link('Nota de Crédito','nota_credito',array('class'=> 'boton letra-chica '));?>
                        </div>
			
			<div id="funciones-impresora">
				<?php echo $html->link('Informe X','cierre_x',array('class'=> 'boton letra-chica'));?>
				<?php echo $html->link('Cierre Z','cierre_z',array('class'=> 'boton letra-chica'));?>
				<?php echo $html->link('Vaciar Cola Impresión','vaciar_cola_impresion_fiscal',array('class'=> 'boton letra-chica'));?>
			</div>
			
			<?php echo $content_for_layout; ?>
		</div>
	</div>
	<?php //echo $javascript->link('cajero/tail'); ?>
	<?php echo $cakeDebug; ?>
	
</body>
</html>
