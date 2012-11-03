<?php
if ($this->request->url == 'admin' || (!empty($this->request->params['admin']) && $this->request->params['admin'] )) {

    ?>
    <?php
    echo $this->Jqm->listview(array(
        array('Home', '/'),
        array('Adicion', '/adition', array('data-ajax' => 'false') ),
    ), array('data-theme' => 'e'));
    ?>

<hr />
    <div data-role="collapsible-set" data-theme="e">

        <div data-role="collapsible" data-content-theme="c">
            <h2>Usuarios</h2>
            <?php
            echo $this->Jqm->listview(array(
                array('Roles', '/admin/roles/index'),
                array('Usuarios', '/admin/users/index'),
                array('Mozos', '/admin/mozos/index'),
            ));
            ?>
        </div> 

        <div data-role="collapsible" data-content-theme="c">
            <h2>Clientes</h2>
            <?php
            echo $this->Jqm->listview(array(
                array('Clientes', '/admin/clientes'),
                array('Descuentos', '/admin/descuentos'),
                array('Tipo de Pagos', '/admin/TipoDePagos'),
            ));
            ?> 
        </div> 

        <div data-role="collapsible" data-content-theme="c">
            <h2>Mesas</h2>
            <?php
            echo $this->Jqm->listview(array(
                array('Listado de Mesas', '/admin/Mesas'),
                array('Nueva Mesa', '/admin/Mesas/add'),
                array('Productos Pedidos', '/admin/detalle_comandas/'),
            ));
            ?> 
        </div>  

        <div data-role="collapsible" data-content-theme="c">
            <h2>Mi Cuenta</h2>
            <?php
            echo $this->Jqm->listview(array(
                array('Modificar Mis Datos', '/users/self_user_edit/' . $this->Session->read('Auth.User.id')),
                array('Modificar Mi Contraseña', '/users/cambiar_password/' . $this->Session->read('Auth.User.id')),
            ));
            ?> 
        </div>   


        <div data-role="collapsible" data-content-theme="c">
            <h2>Productos</h2>
            <?php
            echo $this->Jqm->listview(array(
                array('Categorias', '/admin/categorias'),
                array('Tags', '/admin/tags'),
                array('Productos', '/admin/productos'),
                array('Observaciones de Productos', '/admin/observaciones'),
                array('Observaciones de Comandas', '/admin/observacion_comandas'),
                array('Gustos y Sabores', '/admin/sabores'),
                array('Precios Futuros', '/admin/productos_precios_futuros'),
            ));
            ?> 
        </div> 

<!--        <div data-role="collapsible" data-content-theme="c">
            <h2>Inventario</h2>
            <?php
            echo $this->Jqm->listview(array(
                array('Listar productos', '/inventory/products'),
                array('Agregar producto', '/inventory/products/add'),
                array('Listar categorias', '/inventory/categories'),
                array('Agregar categorias', '/inventory/categories/add'),
                array('Listar inventario, ver al día', '/inventory/counts'),
                array('Agregar stock a inventario', '/inventory/counts/add'),
                array('Listar para imprimir', '/inventory/counts/listar_faltantes_para_imprimir'),
            ));
            ?> 
        </div> -->


        <div data-role="collapsible" data-content-theme="c">
            <h2>Sistema</h2>
            <?php
            echo $this->Jqm->listview(array(
                array('Parametros de configuracion', '/admin/configs'),
                array('Configuraciones del sistema', '/admin/configavanzadas'),
                array('Acciones del sistema', '/admin/sistemaconfig'),
            ));
            ?> 
        </div> 

        <div data-role="collapsible" data-content-theme="c">
            <h2>Servidor</h2>
            <?php
            echo $this->Jqm->listview(array(
                array('Enviar informe estadístico', '/admin/cashier/enviar_informe'),
                array('Reiniciar servidor', '/admin/cashier/reiniciar', null, 'Esta accion reinicia el servidor, y no se puede operar el sistema hasta que se vuelva a iniciar.\n¿Desea hacerlo?'),
                array('Apagar servidor', '/admin/cashier/apagar', null, '¿Desea apagar el servidor?.\n'),
            ));
            ?> 
        </div> 
    </div>
    <?php
}
?>