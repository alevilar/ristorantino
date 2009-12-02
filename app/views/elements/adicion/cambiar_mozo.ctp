
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







<div id="todas-las-mesas-abiertas" style="float: left;">
	<ul class="menu-horizontal">
		<?php foreach ($mesasabiertas as $mesa):?>
		<li>
				<?php echo '<li>'.$ajax->link($mesa['Mesa']['numero'],'/mesas/view/'.$mesa['Mesa']['id'], array( 	'update'=>'mesa-scroll',
																						'id'=>'todas-las-mesas-ver-'.$mesa['Mesa']['id'],
																						'class'=>'boton ',
																						'onclick'=>'contenedorMesasAbiertas.hide();',
																						'evalScripts'=>true
							)).'</li>'
				?>
		</li>
		<?php endforeach;?>
	</ul>
</div>


	<script type="text/javascript">
		var contenedorMesasAbiertas = null;

		contenedorMesasAbiertas = new Window({
						maximizable: false, 
						resizable: false, 
						hideEffect:Element.hide, 
						showEffect:Element.show, 
						minWidth: 10,
						width: 500,
						heigth: 500,
						destroyOnClose: false
					});
		
		contenedorMesasAbiertas.setContent('todas-las-mesas-abiertas', true, true);
				//contentWin.getContent().innerHTML= $('cambiar-mozos-template').innerHTML;
			
</script>
	
<a href="#MostrarMesasABiertas" id="
" class="boton" style="float: left" onclick="contenedorMesasAbiertas.showCenter()">
Mesas
</a>
