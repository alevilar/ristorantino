 
<?php

foreach ($fechas as $fecha=>$mozo) {
?>
<h2><?php echo date('d-m-Y',strtotime($fecha))?></h2>
<table class="fecha-<?php echo "fecha"?>" cellspacing="0" cellpadding="0" style="text-align: center">
        <thead>
            <tr>
                <th>Mozo</th>
                <th>Total</th>
            </tr>
        </thead>
        
        <tbody>
<?php
        foreach($mozo as $m){
            ?>
            <tr>
                <td><?php echo $m['Mozo']['numero']; ?></td>
                <td><?php echo $m['Mozo']['total']; ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>              
    </table>
<?php } ?>


<div class="grid_12 alpha omega">
        <?php 
        echo $form->create('Mesa',array('url'=>'/pquery/stats/mozos_total', 'class' => 'formufecha')); 
        ?>

        <h2>Modificar rango de fechas</h2>
            <?php
            echo "Desde: ".$form->text('Linea.0.desde', array('placeholder'=>'Ej: 22/09/2011','id'=>'from', 'class' =>'datepicker'));
            echo "Hasta: ".$form->text('Linea.0.hasta', array('placeholder'=>'Ej: 30/09/2011','id'=>'to', 'class' =>'datepicker'));  
            echo $form->submit('Aceptar', array('class' => '', 'div' => false));
            ?>

        <?php
        echo $form->end();
        ?>

    </div>