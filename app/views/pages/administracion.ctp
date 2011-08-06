
<div class="grid_6 administracion_menu">
    <div class="grid_7 alpha omega">
    <h2>Mesas</h2>
    <?php
    echo $html->link('Comandas Activas','/Comandas').'<br>';
    echo $html->link('Listado de Mesas','/Mesas').'<br>';
    echo $html->link('Nueva Mesa','/Mesas/add').'<br>';
    ?>
    </div>
    
   <div class="grid_7 alpha omega">
   <h2>Clientes</h2>
    <?php
    echo $html->link('Clientes','/clientes').'<br>';
    echo $html->link('Tipos de Documentos','/tipo_documentos').'<br>';
    echo $html->link('IVA Responsabilidades','/iva_responsabilidades').'<br>';
    echo $html->link('Descuentos','/descuentos').'<br>';
    echo $html->link('Tipo de Pagos','/TipoDePagos').'<br>';
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
    echo $html->link('Gustos y Sabores','/sabores').'<br>';
    echo $html->link('Aplicar Cambios de Precios Futuros','/productos_precios_futuros').'<br>';
    ?>

    <!--
    <h2>Modulo Contable</h2>
    <?php
    echo $html->link('Egresos','/egresos').'<br>';
    ?>
    -->
    </div> 

    <div class="grid_7 alpha omega">
    <h2>Usuarios</h2>
    
    <?php
    echo $html->link('Usuarios','/users/index').'<br>';
    echo $html->link('Permisos','/admin/acl').'<br>';
    echo $html->link('Mozos','/mozos/index').'<br>';
    ?>
    </div>  
      
    <div class="grid_7 alpha omega">
    <h2>Sistema</h2>
    <?php
    echo $html->link('Acciones del sistema','sistemaconfig').'<br>';
    ?>
    </div>
    

</div>
