

<div id="todas-las-mesas-abiertas" style="float: left;">
	<ul class="menu-horizontal">
		<?php foreach ($mesasabiertas as $mesa):?>
		<li>
				<?php echo '<li>'.$ajax->link($mesa['Mesa']['numero']." M(".$mesa['Mozo']['numero'].")",'/mesas/view/'.$mesa['Mesa']['id'], array( 	'update'=>'mesa-scroll',
																						'id'=>'todas-las-mesas-ver-'.$mesa['Mesa']['id'],
																						'class'=>'boton ',
																						'onclick'=>'hacer_cambio_rapido_de_mesa_mozo('.$mesa['Mesa']['numero'].', '.$mesa['Mozo']['numero'].');',
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
				
				
	     function hacer_cambio_rapido_de_mesa_mozo(mesa, mozo){
	    	 contenedorMesasAbiertas.hide();
	    	 $("btn-cambio-rapido-de-mesa").update("Mesa "+mesa+"<br />Mozo "+mozo);
		  }
				
			
</script>
	
<a href="#MostrarMesasABiertas" id="btn-cambio-rapido-de-mesa" class="boton-ancho-largo" style="float: left" onclick="contenedorMesasAbiertas.showCenter()">
Mesa<br />
Mozo
</a>