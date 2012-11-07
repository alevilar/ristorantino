
<div class="mesas form ui-grid-a">
    <?php echo $this->Form->create('Mesa', array('data-direction' => "reverse")); ?>
    <fieldset class="ui-block-a">
        <legend><?php echo __('Datos Generales'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('estado_id');
        echo $this->Form->input('numero', array('after' => '</br>Si cambia este número, cambiara el número de la mesa', 'label' => 'Cambiar Número de Mesa'));
        echo $this->Form->input('mozo_id', array('after' => '</br>Aquí puede cambiar el mozo de la mesa'));
        ?>
    </fieldset>

    <fieldset class="ui-block-b">
        <legend><?php echo __('Totales de Mesa'); ?></legend>
        <?php
        echo $this->Form->input('cant_comensales', array('after' => '</br>Aquí puede cambiar la cantidad de cubiertos de la mesa'));
        echo $this->Form->input('total', array('after' => '</br>Aquí puede cambiar el total de la mesa.'));
        ?>                
    </fieldset>
</div>
<?php echo $this->Form->end('Guardar', array('data-rel' => 'back')); ?>


<div class="detallesmesa">
    <h2>Detalles de la Mesa</h2>
    <p>
        <?php
        echo "Abrió a las <b>" . date('H:i', strtotime($mesa['Mesa']['created'])) . "</b>";

        if (!empty($mesa['Mesa']['time_cerro'])) {
            echo ", Cerró a las <b>" . date('H:i', strtotime($mesa['Mesa']['time_cerro'])) . "</b>";
        }

        if (!empty($mesa['Mesa']['time_cobro'])) {
            echo ", Cobrada a las <b>" . date('H:i', strtotime($mesa['Mesa']['time_cobro'])) . "</b>";
        }
        ?>
    </p>
</div>

<ul class="items_mesas">

    <?php
    $totalSumado = 0;
    foreach ($items as $comanda):
        echo "<li><p>";
        echo "#" . $comanda['id'] . "</p>";
        echo $this->Html->link("Reimprimir Comanda #" . $comanda['id'], array('controller' => 'comandas', 'action' => 'imprimir', $comanda['id']), array('style' => 'float:right;margin-right: 100px;font-size:120%;color:#000000;font-weight: normal;'));
        if ($comanda['observacion']) {
            echo "<cite>Observacion: ";
            echo $comanda['observacion'] . "</cite>";
            //echo "</li>";
        }
        ?>
        <ul>
        <?php foreach ($comanda['DetalleComanda'] as $detalle) { ?>
                <li>
                <?php echo "Cant Pedida: " . $detalle['cant'] . ($detalle['cant_eliminada'] != '0' ? " Sacada: " . $detalle['cant_eliminada'] : '') ?>
                    <br>
                    <span style="color: #AD0101; font-weight: normal; font-size: 120%; <?php if (($detalle['cant'] - $detalle['cant_eliminada']) == 0)
            echo "text-decoration: line-through;" ?> ">
        <?php echo $detalle['cant'] - $detalle['cant_eliminada'] . ")  " . (!empty($detalle['Producto']['name']) ? $detalle['Producto']['name'] : '') . " [p-u $ " . $detalle['Producto']['precio'] . "]" ?>
                    </span>
                </li>
        <?php
        if (count($detalle['DetalleSabor']) > 0) {
            $primero = true;
            echo "<cite>";
            echo "(";
            foreach ($detalle['DetalleSabor'] as $sabor) {
                if (!$primero) {
                    echo ", ";
                }
                $primero = false;
                echo $sabor['Sabor']['name'] . ($sabor['Sabor']['precio'] != '0' ? " [ $" . $sabor['Sabor']['precio'] . "]" : '');

                $totalSumado += ($detalle['cant'] - $detalle['cant_eliminada']) * $sabor['Sabor']['precio'];
            }
            echo ")";
            echo "</cite>";
        }

        $totalSumado += ($detalle['cant'] - $detalle['cant_eliminada']) * $detalle['Producto']['precio'];
    }
    ?>
        </ul>


    </li>
    <?php
endforeach;
?>

</ul>

<div class="mesastotaledit">
    <?php
    //echo "<p>La suma de los productos da: <strong> $$totalSumado</strong></p>";
    //
    //echo "<p><br>Segun funciones especiales:";

    echo "<h3>SUBTOTAL = <span>$$subtotal</span></h3>";
    $dto = empty($mesa['Cliente']['Descuento']['porcentaje']) ? 0 : $mesa['Cliente']['Descuento']['porcentaje'];
    echo "<h3>TOTAL = <span>$$total</span> </h3>";
    if ($dto != '0') {
        echo "(Dto: $dto%)";
    }
    echo "</p>";

    ?>
</div>


<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Borrar'), array('action' => 'delete', $this->Form->value('Mesa.id')), null, sprintf('Seguro que querés borrar la mesa Número # %s?', $this->Form->value('Mesa.numero'))); ?></li>
        <li><?php echo $this->Html->link(__('Listar Mesas'), array('action' => 'index')); ?></li>
    </ul>
</div>