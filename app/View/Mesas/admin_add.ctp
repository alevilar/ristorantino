    <?php    
    $i=0;
    $menubread[$i]['name'] = 'Admin';
    $menubread[$i]['link'] = '/pages/administracion';

    ?>




<div class="mesas form">
<?php echo $this->Form->create('Mesa');?>
	<fieldset>
 		<legend><?php __('Agregar Mesa');?></legend>
	<?php
        //debug($mozos);
		echo $this->Form->input('numero', array('label'=>'Numero de Mesa', 'after'=>'<br>Este dato modifica el valor estadistico acumulado por mesa. Lo ideal es poner el numero de mesa verdadero, caso contrario poner un numero alto.'));
		//$options = array('mozo_id'.'user.nombre');
                echo $this->Form->input('mozo_id');
		echo $this->Form->input('total', array('label'=>'Importe Total'));
		//echo $this->Form->input('descuento_id');
		//echo $this->Form->input('created');
		//echo $this->Form->input('time_paso_pedido');
		//echo $this->Form->input('time_cerro');
		echo $this->Form->input('time_cobro', array('label'=>'Indicar Fecha y hora aproximada',
                    'after'=>'<br><p>Tener en cuenta que esto puede repercutir en la estadistica general. Hay que intentar poner horarios dispersos a lo largo del dia. Por ejemplo, seria malo si se pone que todas las mesas vinieron a las 22hs. Por otro lado, se puede poner un horario raro, asi cuando se sacan las estadisticas se sabe que por ejemplo, todas las mesas que ocmieron a las 18hs son puestas por nosotros a mano. Esta es quizas la mejor opcion.</p>'));

                echo $this->Form->input('tipo_de_pago',array('options'=>$tipo_pagos))
	?>
<?php echo $this->Form->end('Enviar');?>                
	</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar Mesas', true), array('action'=>'index'));?></li>
	</ul>
</div>
