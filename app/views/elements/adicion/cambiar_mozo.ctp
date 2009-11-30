
<div id="cambiar-mozos" class="menu-horizontal" style="display: none; width: 300px">
		<ul>
			<?php foreach ($mozos as $mozo):?>
				<li><?php echo $html->link($mozo['Mozo']['numero'],'/adicion/cambiarMozo/'.$mozo['Mozo']['id'],array(
											'class'=>'boton redondeado letra-grande',
											'style'=> 'font-size: xx-large'
											));?></li>
			<?php endforeach;?>
		</ul>
</div>

<script type="text/javascript">
		var contenedorMozos = null;

		contenedorMozos = new Window({
						maximizable: false, 
						resizable: false, 
						hideEffect:Element.hide, 
						showEffect:Element.show, 
						minWidth: 10,
						width: 400,
						heigth: 400,
						destroyOnClose: false
					});
		
		contenedorMozos.setContent('cambiar-mozos', true, true);
				//contentWin.getContent().innerHTML= $('cambiar-mozos-template').innerHTML;
			
</script>
	
<a href="#cambiarMozo" id="mozo-numero" class="boton" style="float: left" onclick="contenedorMozos.showCenter();">Mozo</a>
	
<script type="text/javascript">
		if(adicion.currentMozo){
			$("mozo-numero").update("Mozo "+adicion.currentMozo.numero);
		}
</script>
	




<a href="#F5Refresh" id="f5-refresh" class="boton" style="float: left" onclick="parent.location.reload();">
Refresh
</a>
	
	