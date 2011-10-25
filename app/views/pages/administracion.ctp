<div class="grid_11 push_1">
<div class="grid_6 administracion_menu">
    
    <div class="grid_7 alpha omega">
        <h2>Usuarios</h2>

        <?php
        echo $html->link('Usuarios','/users/index');
        echo $html->link('Mozos','/mozos/index');
        ?>
    </div> 
    
   <div class="grid_7 alpha omega">
       <h2>Clientes</h2>
        <?php
        echo $html->link('Clientes','/clientes');
        echo $html->link('Descuentos','/descuentos');
        echo $html->link('Tipo de Pagos','/TipoDePagos');
        ?>   
   </div> 
  
   <div class="grid_7 alpha omega">
        <h2>Mesas</h2>
        <?php
        echo $html->link('Comandas Activas','/Comandas');
        echo $html->link('Listado de Mesas','/Mesas');
        echo $html->link('Nueva Mesa','/Mesas/add');
        echo $html->link('Productos Pedidos','/detalle_comandas/');
        ?>
    </div>  

    <div class="grid_7 alpha omega">
        <h2>Mi Cuenta</h2>
        <? echo $html->link('Modificar Mis Datos','/users/self_user_edit/'.$session->read('Auth.User.id')); ?>
        <? echo $html->link('Modificar Mi Contraseña','/users/cambiar_password/'.$session->read('Auth.User.id')); ?>
    </div>   
</div>


<div class="grid_6 administracion_menu">
    <div class="grid_7 alpha omega">
    <h2>Productos</h2>
    <?php
    echo $html->link('Categorias','/categorias');
    echo $html->link('Productos','/productos');
    echo $html->link('Observaciones Prefefinidas','/observaciones');
    echo $html->link('Gustos y Sabores','/sabores');
    echo $html->link('Precios Futuros','/productos_precios_futuros');
    ?>
    </div>
    
    <div class="grid_7 alpha omega">
     <h2>Inventario</h2>
     <ul class="admin_m">
    <?php
    echo $html->link('Listar productos', '/inventory/products');
    echo $html->link('Agregar producto', '/inventory/products/add');
    echo $html->link('Listar categorias', '/inventory/categories');
    echo $html->link('Agregar categorias', '/inventory/categories/add');
    echo $html->link('Listar inventario, ver al día', '/inventory/counts');
    echo $html->link('Agregar stock a inventario', '/inventory/counts/add');
    echo $html->link('Listar para imprimir', '/inventory/counts/listar_faltantes_para_imprimir');    
    ?>
     </div>
    </ul>


    <!--
    <h2>Modulo Contable</h2>
    <?php
    //echo $html->link('Egresos','/egresos');
    ?>
    -->

      
    <div class="grid_7 alpha omega">
    <h2>Sistema</h2>
    <?php
    echo $html->link('Parametros de configuracion','/configs').'<br>';
    echo $html->link('Configuraciones del sistema','configavanzadas');
    echo $html->link('Acciones del sistema','sistemaconfig');
    ?>
    </div>
    
    <div class="grid_7 alpha omega">
    <h2>Servidor</h2>
    <?
    echo $html->link('Reiniciar servidor','/cashier/reiniciar', null, 'Esta accion reinicia el servidor, y no se puede operar el sistema hasta que se vuelva a iniciar.\n¿Desea hacerlo?');
    echo $html->link('Apagar servidor','/cashier/apagar', null, '¿Desea apagar el servidor?.\n');
    ?>
    </div>
    

</div>
</div>
