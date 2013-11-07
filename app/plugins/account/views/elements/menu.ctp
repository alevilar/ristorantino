<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
            <?php echo $html->link('Pendientes de Pago', '/account/gastos')?>
        </li>
        <li>
          <?php echo $html->link('Listado de Gastos', '/account/gastos/history')?>
        </li>
        <li>
            <?php echo $html->link('Gastos x Clasificación', '/account/clasificaciones/gastos')?>
        </li>
        <li>
            <?php echo $html->link('Pagos', '/account/egresos/history')?>
        </li>
        <li>
            <?php echo $html->link('Cierres', '/account/cierres')?>
        </li>
      </ul>      
        
          <?php echo $html->link('Nuevo Gasto', '/account/gastos/add', array('class'=>'btn btn-success pull-right'))?>
</nav>
