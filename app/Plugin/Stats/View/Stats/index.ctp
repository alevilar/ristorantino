<div class="grid_4 push_4">

    <h3>MOZOS</h3>
<?php echo $this->Html->link('<h1>Mesas total / Mozos<h1>', '/pquery/stats/mozos_mesas', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Pagos a mozos<h1>', '/pquery/stats/mozos_pagos', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Productos mas vendidos por mozo<h1>', '/pquery/stats/mozos_productos', array('escape' => false))?>
    </br>
    <h3>MESAS</h3>
<?php echo $this->Html->link('<h1>Ranking mesas con mas ingresos<h1>', '/pquery/stats/mesas_ranking', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Total ingresos de mesa<h1>', '/pquery/stats/mesas_total', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Total de ventas por factura<h1>', '/pquery/stats/mesas_factura', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Total de ventas por tipo de pago<h1>', '/pquery/stats/mesas_pago', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Mesas de clientes<h1>', '/pquery/stats/mesas_clientes', array('escape' => false))?>
        </br>
    <h3>CONTABILIDAD</h3>
<?php echo $this->Html->link('<h1>Ingresos<h1>', '/pquery/stats/cont_ingresos', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Egresos<h1>', '/pquery/stats/cont_egresos', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Cierres de caja<h1>', '/pquery/stats/cont_caja', array('escape' => false))?>
        </br>
    <h3>PRODUCTOS</h3>
<?php echo $this->Html->link('<h1>Los 20 productos más vendidos<h1>', '/pquery/stats/prod_ranking', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Ingresos por categoría<h1>', '/pquery/stats/prod_ingresos', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Pedidos por categoría<h1>', '/pquery/stats/prod_pedidos', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Listado de todos los productos<h1>', '/pquery/stats/prod_listado', array('escape' => false))?>
    <h3>TIEMPO REAL</h3>
<?php echo $this->Html->link('<h1>Mesas abiertas<h1>', '/pquery/stats/real_mesasabiertas', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Comandas enviadas<h1>', '/pquery/stats/real_comandas', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Comensales / mozos<h1>', '/pquery/stats/real_comensales', array('escape' => false))?>
<?php echo $this->Html->link('<h1>Mesas asignadas por mozo<h1>', '/pquery/stats/real_mesasmozos', array('escape' => false))?>
    </br>
    </br>
    
</div>