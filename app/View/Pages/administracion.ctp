<div class="col-md-3">

    <h2>Usuarios</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Usuarios', '/user/users/index', array('class' => 'list-group-item'));
        echo $this->Html->link('Roles', '/user/roles/index', array('class' => 'list-group-item'));
        echo $this->Html->link('Mozos', '/mesa/mozos/index', array('class' => 'list-group-item'));
        ?>
    </div>

    <h2>Mesas</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Listado de Mesas', '/mesa/Mesas', array('class' => 'list-group-item'));
        echo $this->Html->link('Pagos de Mesas', '/mesa/pagos', array('class' => 'list-group-item'));
        echo $this->Html->link('Nueva Mesa', '/mesa/Mesas/add', array('class' => 'list-group-item'));
        
        
        ?>
    </div>

    
</div>



<div class="col-md-3">
    <h2>Productos</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Categorias', '/product/categorias', array('class' => 'list-group-item'));
        echo $this->Html->link('Productos', '/product/productos', array('class' => 'list-group-item'));
        echo $this->Html->link('Sabores', '/product/sabores', array('class' => 'list-group-item'));
        
        echo $this->Html->link('Observaciones de Productos', '/comanda/observaciones', array('class' => 'list-group-item'));
        echo $this->Html->link('Observaciones de Comandas', '/comanda/observacion_comandas', array('class' => 'list-group-item'));
        echo $this->Html->link('Productos Pedidos', '/comanda/detalle_comandas/', array('class' => 'list-group-item'));
        echo $this->Html->link('Tags', '/product/tags', array('class' => 'list-group-item'));
        ?>
    </div>

<!--    <h2>Inventario</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Listar productos', '/inventory/products', array('class' => 'list-group-item'));
        echo $this->Html->link('Agregar producto', '/inventory/products/add', array('class' => 'list-group-item'));
        echo $this->Html->link('Listar categorias', '/inventory/categories', array('class' => 'list-group-item'));
        echo $this->Html->link('Agregar categorias', '/inventory/categories/add', array('class' => 'list-group-item'));
        echo $this->Html->link('Listar inventario, ver al día', '/inventory/counts', array('class' => 'list-group-item'));
        echo $this->Html->link('Agregar stock a inventario', '/inventory/counts/add', array('class' => 'list-group-item'));
        echo $this->Html->link('Listar para imprimir', '/inventory/counts/listar_faltantes_para_imprimir', array('class' => 'list-group-item'));
        ?>
    </div>-->
</div>




<div class="col-md-3">
    <h2>Clientes</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Clientes', '/fidelization/clientes', array('class' => 'list-group-item'));
        echo $this->Html->link('Descuentos', '/fidelization/descuentos', array('class' => 'list-group-item'));        
        ?>   
    </div>

    <h2>Configuración</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Tipo de Pagos', '/TipoDePagos', array('class' => 'list-group-item'));
        
        echo $this->Html->link('Tipos de Documentos', '/tipo_documentos', array('class' => 'list-group-item'));
        echo $this->Html->link('IVA Responsabilidades', '/iva_responsabilidades', array('class' => 'list-group-item'));
        echo $this->Html->link('Permisos de usuarios', '/admin/acl', array('class' => 'list-group-item'));
        ?>
    </div>
</div>



<div class="col-md-3">

    <h2>Impresoras</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('CUPS Printer Manager', FULL_BASE_URL . ':631', array('class' => 'list-group-item'));
        echo $this->Html->link('Comandera', '/Comanderas', array('class' => 'list-group-item'));
        echo $this->Html->link('Listar Dispositivos Fiscales', '/cashier/listar_dispositivos', array('class' => 'list-group-item'));
        ?>
    </div>


    <h2>Estadisticas</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Crear consultas para las estadísticas (avanzado)', '/pquery/queries', array('class' => 'list-group-item'));
        ?>
        <?
        echo $this->Html->link('Enviar informe estadístico', '/cashier/enviar_informe', array('class' => 'list-group-item'));        
        ?>
    </div>


</div>
