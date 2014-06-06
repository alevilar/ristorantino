<div class="pull-left">
<h1>Listado de Cierres Zetas</h1>    
</div>


    <div class="pull-right">
    <?php
    echo $this->Form->create('Zeta', array('type' => 'get', 'url' => $this->action, 'class' => 'form-inline', 'role' => "form"));
    ?>
            <?php echo $this->Form->input('fecha_desde', array(
                'label' => array(
                    'text' => 'Desde',
                    'class' => 'sr-only',
                ),
                'placeholder' => 'Desde',
                'type' => 'date',
            ))?>
        
        
        <?php echo  $this->Form->input('fecha_hasta', array(
                'label' => array(
                    'text' => 'Hasta',
                    'class' => 'sr-only',
                ),
                'placeholder' => 'Hasta',
                'type' => 'date',
            ))?>
        
        <button type="submit" class="btn btn-default">Buscar</button>

    
    <?php
    echo $this->Form->end(null);
    ?>
        <br>
        <?php

        echo $this->Html->link('Descargar Excel', $this->action . '.xls' . strstr($_SERVER['REQUEST_URI'], '?'));
        ?>
    </div>
<br><br>
<div class="clear"></div>
<br><br>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Total Ventas</th>
            <th>#Comprobante</th>
            <th>Monto Iva</th>
            <th>Monto Neto</th>
            <th>Nota de Crédito IVA</th>
            <th>Nota de Crédito Neto</th>
            <th>Observación de las Tarjetas</th>
            <th>Observación del Zeta</th>
            <th>Creado</th>
            <th>Modificado</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($zetas as $z) { ?>
            <tr>
                <td><?php echo $this->Number-> currency($z['Zeta']['total_ventas']) ?></td>
                <td class="center"><?php echo $z['Zeta']['numero_comprobante'] ?></td>
                <td><?php echo $this->Number-> currency($z['Zeta']['monto_iva']) ?></td>
                <td><?php echo $this->Number-> currency($z['Zeta']['monto_neto']) ?></td>
                <td><?php echo $this->Number-> currency($z['Zeta']['nota_credito_iva']) ?></td>
                <td><?php echo $this->Number-> currency($z['Zeta']['nota_credito_neto']) ?></td>
                <td><?php echo $z['Zeta']['observacion_comprobante_tarjeta'] ?></td>
                <td><?php echo $z['Zeta']['observacion'] ?></td>
                <td><?php echo $z['Zeta']['created'] ?></td>
                <td><?php echo $z['Zeta']['modified'] ?></td>
                <td><?php echo $this->Html->link('arqueo', array('controller' => 'arqueos', 'action' => 'edit', $z['Zeta']['arqueo_id'])); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __('Página %page% de %pages%, mostrando %current% elementos de %count%', true)
    ));
    ?>
</p>
<div class="paging">
    <?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class' => 'disabled')); ?>
    | 	<?php echo $this->Paginator->numbers(); ?>
    <?php echo $this->Paginator->next(__('próximo', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
</div>