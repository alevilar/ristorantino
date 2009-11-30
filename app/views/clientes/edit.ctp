<div class="clientes form">
<?php echo $form->create('Cliente');?>
	<fieldset>
 		<legend><?php __('Edit Cliente');?></legend>
	<?php
		echo $form->input('id');
		
		echo $form->input('user_id', array('default'=>'Seleccione','empty'=>'Seleccione'));
		
		echo $form->input('imprime_ticket',array('checked'=>true,'after'=>'Tildar si se desea imprimir ticket, tanto fiscal como en negro. Si no se tilda, entonces cuando se cierre una mesa no se va a imprimir nada.'));
		
		$tipos = array('0'=>'Sin Ticket Factura (en negro)','A'=>'"A"','B'=>'"B"');
		echo $form->input('tipofactura',array('label'=>'Tipo Factura','options'=>$tipos,'after'=>'Tipo de comprobante a imprimir si es que se tildó la opción para imprimir ticket'));
		
		?>		
		
		<div id="div-descuento">		
		<?php echo $form->input('descuento_id',array('empty'=>'Sin Descuento','after'=>'El descuento solo es válido cuando se quiere imprimir en negro'));?>
		</div>
		
		
		<script type="text/javascript">
		$('ClienteTipofactura').observe('change',function(){
				if($F('ClienteTipofactura') != 0){
					$('ClienteDescuentoId').setValue(""); //lo vuelvo a reinicializar al valor, por si fue modificado por error
					$('div-descuento').hide();
				}
				else{
					$('div-descuento').show();
				}
			});
		</script>
		
		
		
		<?		
		echo $form->input('nombre',array('label'=>'Nombre/Denominación','after'=>'Ej: La Serenissima S.A.'));
		
		
		$tipos = array(''=>'Seleccione','C'=>'CUIT','L'=>'CUIL','0'=>'Libreta de Enrolamiento', '1'=> 'Libreta Cívica','2'=>'DNI','3'=>'Pasaporte','4'=>'Cédula de Identidad',' '=>'Sin Identificar');
		echo $form->input('tipodocumento', array('options'=>$tipos,'label'=>'Tipo de Identificación'));
		echo $form->input('nrodocumento',array('label'=>'Número'));
		
		
		
		
		echo $form->input('domicilio');
		$respo = array(''=>'Seleccione','I'=>'Resp. Inscipto','E'=>'Exento','A'=>'No Responsable','C'=>'Consumidor Final','T'=>'No Categorizado');
		echo $form->input('responsabilidad_iva', array('options'=>$respo,'empty'=>'Seleccione'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Cliente.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Cliente.id'))); ?></li>
		<li><?php echo $html->link(__('List Clientes', true), array('action'=>'index'));?></li>
	</ul>
</div>
