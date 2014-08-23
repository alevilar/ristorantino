<?php
echo $this->Html->css('/cash/css/style_cash');


?>



<h1>Listado de Arqueos</h1>


<div class="pull-right">
<?php foreach ($cajas as $cId=>$cName) { ?>
    <?php 
        echo $this->Html->link('Hacer Arqueo de '.$cName, array('controller'=>'arqueos', 'action'=>'add', $cId), array('class'=>'btn btn-md  btn-primary'));
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
      ?>
<?php } ?>

</div>

<br><br>



<table class="table table-hover">
    <thead>
        <tr>
            <th>Caja</th>
            <th>Fecha</th>
            <th>Saldo</th>
            <th>Importe Inicial</th>
            <th>Ventas</th>
            <th>Otros Ingresos</th>
            <th>Pagos</th>
            <th>Otros Egresos</th>
            <th>Importe Final</th>
            <th>Creado</th>
            <th>Modificado</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($arqueos as $arq) { ?>
            <?php
            $tdClass = '';
            if (isset($arq['Arqueo']['saldo'])) {
                if (abs($arq['Arqueo']['saldo']) == 0) {
                    $tdClass = 'success';
                } elseif (abs($arq['Arqueo']['saldo']) < 11) {
                    $tdClass = 'warning';
                } else {
                    $tdClass = 'danger';
                }
            }
            ?>
            <tr class="<?php echo $tdClass ?>">
                <td><?php echo $arq['Caja']['name'] ?></td>
                <td><?php echo strftime('%a %d de %b %H:%M ', strtotime($arq['Arqueo']['datetime'])) ?></td>


                <td><?php echo $this->Number->currency($arq['Arqueo']['saldo']) ?></td>

                <td><?php echo  $this->Number->currency($arq['Arqueo']['importe_inicial']) ?></td>
                <td><?php echo  $this->Number->currency($arq['Arqueo']['ingreso']) ?></td>
                <td><?php echo  $this->Number->currency($arq['Arqueo']['otros_ingresos']) ?></td>
                <td><?php echo  $this->Number->currency($arq['Arqueo']['egreso']) ?></td>
                <td><?php echo  $this->Number->currency($arq['Arqueo']['otros_egresos']) ?></td>
                <td><?php echo  $this->Number->currency($arq['Arqueo']['importe_final']) ?></td>
                <td><?php echo date('d/m/Y H:i:s', strtotime($arq['Arqueo']['created'])) ?></td>
                <td><?php echo date('d/m/Y H:i:s', strtotime($arq['Arqueo']['modified'])) ?></td>
                <td><?php echo $this->Html->link('Editar', 'edit/' . $arq['Arqueo']['id']); ?></td>
            </tr>

        <?php } ?>
    </tbody>
</table>


<p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __('Página {:page} de {:pages}, mostrando {:current} elementos de {:count}', true)
    ));
    ?>
</p>
<div class="paging">
    <?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class' => 'disabled')); ?>
    | 	<?php echo $this->Paginator->numbers(); ?>
    <?php echo $this->Paginator->next(__('próximo', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
</div>