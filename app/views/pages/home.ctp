
<ul class="dashboard-buttons">
        <li>
        <?php echo $html->link('Adición','/adition/adicionar',array('id'=>'bton-adicion'));?>
        </li>
        
        <li>
        <?php echo $html->link('Caja','/adition/adicionar/#listado-mesas-cerradas',array('id'=>'bton-caja'));?>
        </li>

        <li>   
        <?php echo $html->link('Admin','/pages/administracion',array('id'=>'bton-admin'));?>
        </li>  
<!--    
        <li>   
        <?php echo $html->link('Inventario','/inventory',array('id'=>'bton-inven'));?>
        </li>  
    <li>  
        <?php echo $html->link('Contabilidad','/account',array('id'=>'bton-contabilidad'));?>
        </li>    
        -->
        <li>  
        <?php echo $html->link('Estadisticas','/stats/mesas_total',array('id'=>'bton-estadisticas'));?>
        </li>     
    
           
        
</ul>