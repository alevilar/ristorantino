
<div class="grid_6">

    <h2>Usuarios y Clientes</h2>
    <?php
    echo $html->link('Usuarios','/users/index').'<br>';
    echo $html->link('Permisos','/admin/acl').'<br>';
    echo $html->link('Mozos','/mozos/index').'<br>';
    echo $html->link('Clientes','/clientes').'<br>';
    echo $html->link('-   Tipo de Documentos','/tipo_documentos').'<br>';
    echo $html->link('-   IVA Responsabilidades','/iva_responsabilidades').'<br>';
    echo $html->link('Descuentos','/descuentos').'<br>';
    echo $html->link('Tipo de Pagos','/TipoDePagos').'<br>';
    ?>

    <h2>Mesas</h2>
    <?php
    echo $html->link('Comandas Activas','/Comandas').'<br>';
    echo $html->link('Listado de Mesas','/Mesas').'<br>';
    echo $html->link('Nueva Mesa','/Mesas/add').'<br>';
    ?>

    <h2>Mi Cuenta</h2>
    <? echo $html->link('Modificar Mis Datos','/users/self_user_edit/'.$session->read('Auth.User.id')).'<br>'; ?>
    <? echo $html->link('Modificar Mi Contraseña','/users/cambiar_password/'.$session->read('Auth.User.id')); ?>
</div>


<div class="grid_6">
    <h2>Productos</h2>
    <?php
    echo $html->link('Categorias','/categorias').'<br>';
    echo $html->link('Productos','/productos').'<br>';
    echo $html->link('Gustos y Sabores','/sabores').'<br>';
    echo $html->link('Aplicar Cambios de Precios Futuros','/productos/actualizarPreciosFuturos').'<br>';
    ?>

    <!--
    <h2>Modulo Contable</h2>
    <?php
    echo $html->link('Egresos','/egresos').'<br>';
    ?>
    -->

    <h2>Configuración de impresoras</h2>
    <?php
    echo $html->link('CUPS Printer Manager',FULL_BASE_URL.':631').'<br>';
    echo $html->link('Comandera','/Comanderas').'<br>';
    echo $html->link('Listar Dispositivos Fiscales','/cashier/listar_dispositivos').'<br>';
    ?>
    <h2>Informes y Configuración</h2>
    <?php
    echo $html->link('Parametros de configuracion','/configs').'<br>';
    echo $html->link('Crear consultas para las estadísticas (avanzado)','/pquery/queries').'<br>';
    ?>
    <h2>Servidor</h2>
    <?
    echo $html->link('Reiniciar servidor','/cashier/reiniciar', null, 'Ojo que esta accion hace que no se pueda operar el sistema hasta que no se reinicie.\n¿Seguro No ?').'<br>';
    echo $html->link('Apagar servidor','/cashier/apagar', null, 'Está a punto de apagar el servidor.\n¿Seguro No ?');
    ?>
</div>
