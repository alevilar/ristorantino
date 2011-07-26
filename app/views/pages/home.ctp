<div id='botonera_home' class="menu-horizontal grid_10 prefix_1">

        <div class="grid_5 push_1 divboton">
        <?php echo $html->link('Adición','/adition/adicionar',array('style'=>'margin-left:auto;margin-right:auto;', 'id'=>'bton-adicion'));?>
        </div>
        
        <div class="grid_5 push_1 divboton">
        <?php echo $html->link('Caja','/cashier/cobrar',array('style'=>'margin-left:auto;margin-right:auto;', 'id'=>'bton-caja'));?>
        </div>

        <div class="grid_3 push_1 divboton" style="margin-left: 5%">   
        <?php echo $html->link('Admin','/pages/administracion',array('style'=>'margin-left:auto;margin-right:auto;', 'id'=>'bton-admin'));?>
        </div>  
        
        <div class="grid_3 push_1 divboton">  
        <?php echo $html->link('Estadisticas','/pquery/stats/mesas_total',array('style'=>'margin-left:auto;margin-right:auto;', 'id'=>'bton-estadisticas'));?>
        </div>     
    
        <div class="grid_3 push_1 divboton">  
        <?php echo $html->link('Contabilidad','/account',array('style'=>'margin-left:auto;margin-right:auto;', 'id'=>'bton-contabilidad'));?>
        </div>       
        <!--
        <div class="grid_6">
            <?php echo $html->link('Ventas','/pquery/queries/list_view/5',array('class'=>'boton 		redondeado','style'=>'margin:auto;', 'class'=>'boton'));?>
        </div>

        <div class="grid_6">
            <?php echo $html->link('Ventas Mozo','/pquery/queries/list_view/10',array('class'=>'boton 		redondeado','style'=>'margin:auto;', 'class'=>'boton'));?>
        </div>
        -->
</div>
	

