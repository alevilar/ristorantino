<div class="grid_4 push_4">

    <h3>MOZOS</h3>
<?php echo $html->link('<h1>Mesas total / Mozos<h1>', '/pquery/stats/mozosmesas', array('escape' => false))?>
<?php echo $html->link('<h1>Pagos a mozos<h1>', '/pquery/stats/mozospagos', array('escape' => false))?>
<?php echo $html->link('<h1>Productos mas vendidos por mozo<h1>', '/pquery/stats/mozosproductos', array('escape' => false))?>
    </br>
    <h3>MESAS</h3>
<?php echo $html->link('<h1>Ranking mesas con mas ingresos<h1>', '/pquery/stats/mesasranking', array('escape' => false))?>
<?php echo $html->link('<h1>Total ingresos de mesa<h1>', '/pquery/stats/mesastotal', array('escape' => false))?>
<?php echo $html->link('<h1>Total de ventas por factura<h1>', '/pquery/stats/mesasfactura', array('escape' => false))?>
<?php echo $html->link('<h1>Total de ventas por tipo de pago<h1>', '/pquery/stats/mesaspago', array('escape' => false))?>
<?php echo $html->link('<h1>Mesas de clientes<h1>', '/pquery/stats/mesasclientes', array('escape' => false))?>
        </br>
    <h3>CONTABILIDAD</h3>
<?php echo $html->link('<h1>Ingresos<h1>', '/pquery/stats/contingr', array('escape' => false))?>
<?php echo $html->link('<h1>Egresos<h1>', '/pquery/stats/contingresos', array('escape' => false))?>
<?php echo $html->link('<h1>Cierres de caja<h1>', '/pquery/stats/contcaja', array('escape' => false))?>
        </br>
    <h3>PRODUCTOS</h3>
<?php echo $html->link('<h1>Los 20 productos más vendidos<h1>', '/pquery/stats/prodranking', array('escape' => false))?>
<?php echo $html->link('<h1>Ingresos por categoría<h1>', '/pquery/stats/prodingresos', array('escape' => false))?>
<?php echo $html->link('<h1>Pedidos por categoría<h1>', '/pquery/stats/prodpedidos', array('escape' => false))?>
<?php echo $html->link('<h1>Listado de todos los productos<h1>', '/pquery/stats/prodlistado', array('escape' => false))?>
    <h3>TIEMPO REAL</h3>
<?php echo $html->link('<h1>Mesas abiertas<h1>', '/pquery/stats/realmesasabiertas', array('escape' => false))?>
<?php echo $html->link('<h1>Comandas enviadas<h1>', '/pquery/stats/realcomandas', array('escape' => false))?>
<?php echo $html->link('<h1>Comensales / mozos<h1>', '/pquery/stats/realcomensales', array('escape' => false))?>
<?php echo $html->link('<h1>Mesas asignadas por mozo<h1>', '/pquery/stats/realmesasmozos', array('escape' => false))?>
    </br>
    </br>
    
</div>