
    <?php    
  //  echo $this->element('menuadmin');
    ?>

    <div data-role="header">
        <a href="#mesa-view" data-transition="reverse">Volver</a>
        <h1>Clientes</h1>
    </div>
    
    <div data-role="content" >


        <div class="clientes index">
        <p>
        <?php
//        echo $this->Paginator->counter(array(
//        'format' => __('Página %page% de %pages%, mostrando %current% elementos de %count%', true)
//        ));
        ?></p>
        <table cellpadding="0" cellspacing="0">
            
             <tr>
                <?php echo $this->Form->create("Cliente",array("action"=>"index")); echo $this->Form->input("id") ?>
                <th><?php echo $this->Form->input('nombre',array('style'=>'width:170px;','placeholder'=>'Nombre del cliente', 'label'=>false));?></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><?php echo $this->Form->input('nrodocumento',array('style'=>'width:120px;','placeholder'=>'CUIT / CUIL / DNI','label'=>false));?></th>
                <th></th>
                <th class="actions"><?php echo $this->Form->end("Buscar")?></th>
                </tr>
                
                
        <tr>
                <th><?php echo $this->Paginator->sort('nombre');?></th>
                <th><?php echo $this->Paginator->sort('Usuario','User.username');?></th>
                <th><?php echo $this->Paginator->sort('Descuento','Descuento.name');?></th>
                <th style="text-align: center;"><?php echo $this->Paginator->sort('IVA','IvaResponsabilidad');?></th>
                <th><?php echo $this->Paginator->sort('Factura','tipofactura');?></th>
                <th><?php echo $this->Paginator->sort('Ticket','imprime_ticket');?></th>
                <th><?php echo $this->Paginator->sort('CUIT/CUIL/DNI', 'nrodocumento');?></th>
                <th><?php echo $this->Paginator->sort('Creado','created');?></th>
                <th class="actions"><?php __('Acciones');?></th>
        </tr>
        <?php

        if ($this->Paginator->params['paging']['Cliente']['count']!=0) {
        $i = 0;
        foreach ($clientes as $cliente):
                $class = null;
                if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                }
        ?>
                <tr<?php echo $class;?>>
                        <td>
                                <?php echo $cliente['Cliente']['nombre']; ?>
                        </td>
                        <td title="<?php echo $cliente['User']['nombre'].", ".$cliente['User']['apellido']; ?>">
                                <?php echo $cliente['User']['username']; ?>
                        </td>
                        <td title="<?php echo $cliente['Descuento']['description']." (%".$cliente['Descuento']['porcentaje'].")"; ?>">
                                <?php echo $cliente['Descuento']['name']; ?>
                        </td>
                        <td>
                                <?php echo ($cliente['IvaResponsabilidad']['name']); ?>
                        </td>
                        <td style="text-align: center;">
                                <?php echo ($cliente['Cliente']['tipofactura'])?'"'.$cliente['Cliente']['tipofactura'].'"':'Remito'; ?>
                        </td>

                        <td style="text-align: center;">
                                <?php echo ($cliente['Cliente']['imprime_ticket'])?'Si':'No'; ?>
                        </td>

                        <td>
                                <?php 
                                 echo (!empty($cliente['TipoDocumento']['name']))?$cliente['Cliente']['nrodocumento']." (".$cliente['TipoDocumento']['name'].")":''; 
                                 ?>
                        </td>
                        <td>
                                <?php echo date('d/m/Y H:i',strtotime($cliente['Cliente']['created'])); ?>
                        </td>
                        <td class="actions">
                                <?php echo $this->Html->link(__('Ver', true), array('action'=>'view', $cliente['Cliente']['id'])); ?>
                                <?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $cliente['Cliente']['id'])); ?>
                                <?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $cliente['Cliente']['id']), null, sprintf(__('¿Está seguro que desea borrar el cliente: %s?', true), $cliente['Cliente']['nombre'])); ?>
                        </td>
                </tr>
        <?php endforeach; 
        }else{
            echo('<td>No se encontraron clientes</td>');
        }
        ?>

               


        </table>

        </div>
        <div class="paging">
                <?php echo $this->Paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
         | 	<?php echo $this->Paginator->numbers();?>
                <?php echo $this->Paginator->next(__('próximo', true).' >>', array(), null, array('class'=>'disabled'));?>
        </div>
        <div class="actions">
                <ul>
                        <li><?php echo $this->Html->link(__('Crear Cliente', true), array('action'=>'add')); ?></li>
                </ul>
        </div>
        
    </div>