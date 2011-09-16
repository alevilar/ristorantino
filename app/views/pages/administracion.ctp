<div class="grid_11 push_1">
<div class="grid_6 administracion_menu">
    
    <div class="grid_7 alpha omega">
        <h2>Usuarios</h2>

        <?php
        echo $html->link('Usuarios','/users/index').'<br>';
        echo $html->link('Mozos','/mozos/index').'<br>';
        ?>
    </div> 
    
   <div class="grid_7 alpha omega">
       <h2>Clientes</h2>
        <?php
        echo $html->link('Clientes','/clientes').'<br>';
        echo $html->link('Descuentos','/descuentos').'<br>';
        echo $html->link('Tipo de Pagos','/TipoDePagos').'<br>';
        ?>   
   </div> 
  
   <div class="grid_7 alpha omega">
        <h2>Mesas</h2>
        <?php
        echo $html->link('Comandas Activas','/Comandas').'<br>';
        echo $html->link('Listado de Mesas','/Mesas').'<br>';
        echo $html->link('Nueva Mesa','/Mesas/add').'<br>';
        ?>
    </div>  

    <div class="grid_7 alpha omega">
        <h2>Mi Cuenta</h2>
        <? echo $html->link('Modificar Mis Datos','/users/self_user_edit/'.$session->read('Auth.User.id')).'<br>'; ?>
        <? echo $html->link('Modificar Mi Contraseña','/users/cambiar_password/'.$session->read('Auth.User.id')); ?>
    </div>   
</div>


<div class="grid_6 administracion_menu">
    <div class="grid_7 alpha omega">
    <h2>Productos</h2>
    <?php
    echo $html->link('Categorias','/categorias').'<br>';
    echo $html->link('Productos','/productos').'<br>';
    echo $html->link('Observaciones Prefefinidas','/observaciones').'<br>';
    echo $html->link('Gustos y Sabores','/sabores').'<br>';
    echo $html->link('Precios Futuros','/productos_precios_futuros').'<br>';
    ?>
    </div>
    
    <div class="grid_7 alpha omega">
     <h2>Inventario</h2>
     <ul class="admin_m">
    <?php
    echo '<li>'.$html->link('Listar productos', '/inventory/products').'</li>';
    echo '<li>'.$html->link('Agregar producto', '/inventory/products/add').'</li>';
    echo '<li>'.$html->link('Listar categorias', '/inventory/categories').'</li>';
    echo '<li>'.$html->link('Agregar categorias', '/inventory/categories/add').'</li>';
    echo '<li>'.$html->link('Listar inventario, ver al día', '/inventory/counts').'</li>';
    echo '<li>'.$html->link('Agregar stock a inventario', '/inventory/counts/add').'</li>';
    echo '<li>'.$html->link('Listar para imprimir', '/inventory/counts/listar_faltantes_para_imprimir').'</li>';    
    ?>
     </div>
    </ul>


    <!--
    <h2>Modulo Contable</h2>
    <?php
    //echo $html->link('Egresos','/egresos').'<br>';
    ?>
    -->

      
    <div class="grid_7 alpha omega">
    <h2>Sistema</h2>
    <?php
    echo $html->link('Configuraciones del sistema','configavanzadas').'<br>';
    ?>
    <?php
    echo $html->link('Acciones del sistema','sistemaconfig').'<br>';
    ?>
    </div>
    
    <div class="grid_7 alpha omega">
    <h2>Servidor</h2>
    <?
    echo $html->link('Reiniciar servidor','/cashier/reiniciar', null, 'Esta accion reinicia el servidor, y no se puede operar el sistema hasta que se vuelva a iniciar.\n¿Desea hacerlo?').'<br>';
    echo $html->link('Apagar servidor','/cashier/apagar', null, '¿Desea apagar el servidor?.\n');
    ?>
    </div>
    

</div>
</div>
