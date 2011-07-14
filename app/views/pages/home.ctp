

<div id='botonera_home' class="menu-horizontal grid_10 prefix_2">
    <div class="grid_5">
        <?php echo $html->link('Adición','/adition/adicionar',array('class'=>'boton redondeado','style'=>'margin-left:auto;margin-right:auto;', 'id'=>'bton-adicion'));?>
	<?php echo $html->link('Admin','/pages/administracion',array('class'=>'boton redondeado','style'=>'margin-left:auto;margin-right:auto;', 'id'=>'bton-admin'));?>
    </div>

    <div class="grid_5">
        <?php echo $html->link('Caja','/cashier/cobrar',array('class'=>'boton redondeado','style'=>'margin-left:auto;margin-right:auto;', 'id'=>'bton-caja'));?>
        <?php echo $html->link('Estadisticas','/pquery/stats/mesas_total',array('class'=>'boton redondeado','style'=>'margin-left:auto;margin-right:auto;', 'id'=>'bton-estadisticas'));?>
        
        <!--
        <div class="grid_6">
            <?php echo $html->link('Ventas','/pquery/queries/list_view/5',array('class'=>'boton 		redondeado','style'=>'margin:auto;', 'class'=>'boton'));?>
        </div>

        <div class="grid_6">
            <?php echo $html->link('Ventas Mozo','/pquery/queries/list_view/10',array('class'=>'boton 		redondeado','style'=>'margin:auto;', 'class'=>'boton'));?>
        </div>
        -->
    </div>
</div>
	

