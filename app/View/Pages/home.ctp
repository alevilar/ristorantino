
<ul class="dashboard-buttons">
        <li>
        <?php echo $this->Html->link('Adición','/adition',array('id'=>'bton-adicion'));?>
        </li>
        
        <li>
        <?php echo $this->Html->link('Caja','/adition/adicionar/#listado-mesas-cerradas',array('id'=>'bton-caja'));?>
        </li>

        <li>   
        <?php echo $this->Html->link('Admin','/pages/administracion',array('id'=>'bton-admin'));?>
        </li>  
<!--    
        <li>   
        <?php echo $this->Html->link('Inventario','/inventory',array('id'=>'bton-inven'));?>
        </li>  
    <li>  
        <?php echo $this->Html->link('Contabilidad','/account',array('id'=>'bton-contabilidad'));?>
        </li>    
        -->
        <li>  
        <?php echo $this->Html->link('Estadisticas','/stats/mesas_total',array('id'=>'bton-estadisticas'));?>
        </li>     
    
           
        
</ul>
