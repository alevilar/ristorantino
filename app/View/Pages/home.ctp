<?php
echo $this->Html->css('ristorantino/home/ristorantino.home');
?>
<div class="jumbotron">
    <div style="text-align: center">
    <h1><?php echo Configure::read('Restaurante.name');?></h1>
  
  </div>
  <p>
   <ul class="dashboard-buttons">
    <li>
        <?php echo $this->Html->link('Adición', '/adition/adicionar', array('id' => 'bton-adicion')); ?>
    </li>

    <li>
        <?php echo $this->Html->link('Caja', '/adition/adicionar/#listado-mesas-cerradas', array('id' => 'bton-caja')); ?>
    </li>

    <li>   
        <?php echo $this->Html->link('Admin', '/pages/administracion', array('id' => 'bton-admin')); ?>
    </li>  

<!--    <li>   
        <?php echo $this->Html->link('Inventario', '/inventory', array('id' => 'bton-inven')); ?>
    </li>  -->
   </ul>
  
  <ul class="dashboard-buttons">

    <li>  
        <?php echo $this->Html->link('Estadisticas', '/stats/mesas_total', array('id' => 'bton-estadisticas')); ?>
    </li>     

    <li>  
        <?php echo $this->Html->link('Contabilidad', array('controller' => 'account', 'action' => 'index', 'plugin' => 'account'), array('id' => 'bton-contabilidad')); ?>
    </li>       

    <li>  
        <?php echo $this->Html->link('Arqueo', '/cash/arqueos', array('id' => 'bton-arqueo')); ?>
    </li>     

</ul>
      
  </p>
</div>
