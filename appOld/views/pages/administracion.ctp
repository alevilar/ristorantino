<div class="col-md-3">

    <h2>Usuarios</h2>
    <div class="list-group">
        <?php
        echo $html->link('Usuarios', '/users/index', array('class' => 'list-group-item'));
        echo $html->link('Roles', '/roles/index', array('class' => 'list-group-item'));
        echo $html->link('Mozos', '/mozos/index', array('class' => 'list-group-item'));
        ?>
    </div>

    <h2>Clientes</h2>
    <div class="list-group">
        <?php
        echo $html->link('Clientes', '/clientes', array('class' => 'list-group-item'));
        echo $html->link('Descuentos', '/descuentos', array('class' => 'list-group-item'));
        echo $html->link('Tipo de Pagos', '/TipoDePagos', array('class' => 'list-group-item'));
        ?>   
    </div>
</div>

<div class="col-md-3">
    <h2>Mesas</h2>
    <div class="list-group">
        <?php
        echo $html->link('Listado de Mesas', '/Mesas', array('class' => 'list-group-item'));
        echo $html->link('Pagos de Mesas', '/pagos', array('class' => 'list-group-item'));
        echo $html->link('Nueva Mesa', '/Mesas/add', array('class' => 'list-group-item'));
        
        
        ?>
    </div>

    <h2>Mi Cuenta</h2>
    <div class="list-group">
        <? echo $html->link('Modificar Mis Datos', '/users/self_user_edit/' . $session->read('Auth.User.id'), array('class' => 'list-group-item')); ?>
        <? echo $html->link('Modificar Mi Contraseña', '/users/cambiar_password/' . $session->read('Auth.User.id'), array('class' => 'list-group-item')); ?>
    </div>
</div>

<div class="col-md-3">
    <h2>Productos</h2>
    <div class="list-group">
        <?php
        echo $html->link('Categorias', '/categorias', array('class' => 'list-group-item'));
        echo $html->link('Productos', '/productos', array('class' => 'list-group-item'));
        echo $html->link('Sabores', '/sabores', array('class' => 'list-group-item'));
        echo $html->link('Observaciones de Productos', '/observaciones', array('class' => 'list-group-item'));
        echo $html->link('Observaciones de Comandas', '/observacion_comandas', array('class' => 'list-group-item'));
        echo $html->link('Productos Pedidos', '/detalle_comandas/', array('class' => 'list-group-item'));
        echo $html->link('Tags', '/tags', array('class' => 'list-group-item'));
        ?>
    </div>

<!--    <h2>Inventario</h2>
    <div class="list-group">
        <?php
        echo $html->link('Listar productos', '/inventory/products', array('class' => 'list-group-item'));
        echo $html->link('Agregar producto', '/inventory/products/add', array('class' => 'list-group-item'));
        echo $html->link('Listar categorias', '/inventory/categories', array('class' => 'list-group-item'));
        echo $html->link('Agregar categorias', '/inventory/categories/add', array('class' => 'list-group-item'));
        echo $html->link('Listar inventario, ver al día', '/inventory/counts', array('class' => 'list-group-item'));
        echo $html->link('Agregar stock a inventario', '/inventory/counts/add', array('class' => 'list-group-item'));
        echo $html->link('Listar para imprimir', '/inventory/counts/listar_faltantes_para_imprimir', array('class' => 'list-group-item'));
        ?>
    </div>-->
</div>

<div class="col-md-3">
    <h2>Sistema</h2>
    <div class="list-group">
        <?php
        echo $html->link('Parametros de configuracion', '/configs', array('class' => 'list-group-item'));
        echo $html->link('Configuraciones del sistema', 'configavanzadas', array('class' => 'list-group-item'));
        ?>
    </div>

    <h2>Servidor</h2>
    <div class="list-group">
        <?
        echo $html->link('Enviar informe estadístico', '/cashier/enviar_informe', array('class' => 'list-group-item'));
        echo $html->link('Reiniciar servidor', '/cashier/reiniciar', array('class' => 'list-group-item'), 'Esta accion reinicia el servidor, y no se puede operar el sistema hasta que se vuelva a iniciar.\n¿Desea hacerlo?');
        echo $html->link('Apagar servidor', '/cashier/apagar', array('class' => 'list-group-item'), '¿Desea apagar el servidor?.\n');
        ?>
    </div>
</div>
