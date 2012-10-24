<div class="grid_4 administracion_menu">
    
    <p>
        <h2>Usuarios</h2>

        <?php
        echo $this->Html->link('Usuarios','/users/index');        
        echo $this->Html->link('Mozos','/mozos/index');
        echo $this->Html->link('Roles','/roles/index');
        ?>
    </p> 
    
   <p>
       <h2>Clientes</h2>
        <?php
        echo $this->Html->link('Clientes','/clientes');
        echo $this->Html->link('Descuentos','/descuentos');
        echo $this->Html->link('Tipo de Pagos','/TipoDePagos');
        ?>   
   </p> 
  
   <p>
        <h2>Mesas</h2>
        <?php
        echo $this->Html->link('Comandas Activas','/Comandas');
        echo $this->Html->link('Listado de Mesas','/Mesas');
        echo $this->Html->link('Nueva Mesa','/Mesas/add');
        echo $this->Html->link('Productos Pedidos','/detalle_comandas/');
        ?>
    </p>  

    <p>
        <h2>Mi Cuenta</h2>
        <? echo $this->Html->link('Modificar Mis Datos','/users/self_user_edit/'.$this->Session->read('Auth.User.id')); ?>
        <? echo $this->Html->link('Modificar Mi Contraseña','/users/cambiar_password/'.$this->Session->read('Auth.User.id')); ?>
    </p>   
</div>


<div class="grid_4 administracion_menu">
    <p>
    <h2>Productos</h2>
    <?php
    echo $this->Html->link('Categorias','/categorias');
    echo $this->Html->link('Tags','/tags');
    echo $this->Html->link('Productos','/productos');
    echo $this->Html->link('Observaciones de Productos','/observaciones');
    echo $this->Html->link('Observaciones de Comandas','/observacion_comandas');
    echo $this->Html->link('Gustos y Sabores','/sabores');
    echo $this->Html->link('Precios Futuros','/productos_precios_futuros');
    ?>
    </p>
    
    <p>
     <h2>Inventario</h2>
     <ul class="admin_m">
    <?php
    echo $this->Html->link('Listar productos', '/inventory/products');
    echo $this->Html->link('Agregar producto', '/inventory/products/add');
    echo $this->Html->link('Listar categorias', '/inventory/categories');
    echo $this->Html->link('Agregar categorias', '/inventory/categories/add');
    echo $this->Html->link('Listar inventario, ver al día', '/inventory/counts');
    echo $this->Html->link('Agregar stock a inventario', '/inventory/counts/add');
    echo $this->Html->link('Listar para imprimir', '/inventory/counts/listar_faltantes_para_imprimir');    
    ?>
          </ul>
     </p>
   


    <!--
    <h2>Modulo Contable</h2>
    <?php
    //echo $this->Html->link('Egresos','/egresos');
    ?>
    -->
</div>

<div class="grid_4 administracion_menu">
    <p>
    <h2>Sistema</h2>
    <?php
    echo $this->Html->link('Parametros de configuracion','/configs').'<br>';
    echo $this->Html->link('Configuraciones del sistema','configavanzadas');
    echo $this->Html->link('Acciones del sistema','sistemaconfig');
    ?>
    </p>
    
    <p>
    <h2>Servidor</h2>
    <?
    echo $this->Html->link('Enviar informe estadístico','/cashier/enviar_informe');
    echo $this->Html->link('Reiniciar servidor','/cashier/reiniciar', null, 'Esta accion reinicia el servidor, y no se puede operar el sistema hasta que se vuelva a iniciar.\n¿Desea hacerlo?');
    echo $this->Html->link('Apagar servidor','/cashier/apagar', null, '¿Desea apagar el servidor?.\n');
    ?>
    </p>
</div>
