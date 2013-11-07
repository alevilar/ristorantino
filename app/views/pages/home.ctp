<?php
echo $html->css('ristorantino.home');
?>
<div class="jumbotron">
    <div style="text-align: center">
    <h1>COQUS</h1>
  <h2>El Ristorantino Mágico</h2>
  </div>
  <p>
   <ul class="dashboard-buttons">
    <li>
        <?php echo $html->link('Adición', '/adition/adicionar', array('id' => 'bton-adicion')); ?>
    </li>

    <li>
        <?php echo $html->link('Caja', '/adition/adicionar/#listado-mesas-cerradas', array('id' => 'bton-caja')); ?>
    </li>

    <li>   
        <?php echo $html->link('Admin', '/pages/administracion', array('id' => 'bton-admin')); ?>
    </li>  

    <li>   
        <?php echo $html->link('Inventario', '/inventory', array('id' => 'bton-inven')); ?>
    </li>  
   </ul>
  
  <ul class="dashboard-buttons">

    <li>  
        <?php echo $html->link('Estadisticas', '/stats/mesas_total', array('id' => 'bton-estadisticas')); ?>
    </li>     

    <li>  
        <?php echo $html->link('Contabilidad', array('controller' => 'account', 'action' => 'index', 'plugin' => 'account'), array('id' => 'bton-contabilidad')); ?>
    </li>       

    <li>  
        <?php echo $html->link('Arqueo', '/cash/arqueos/help', array('id' => 'bton-arqueo')); ?>
    </li>     

</ul>
      
  </p>
</div>
