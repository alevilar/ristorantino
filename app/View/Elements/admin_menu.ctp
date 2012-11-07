    <?php
    return;
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
                array('Roles', '/roles/index'),
                array('Usuarios', '/users/index'),
                array('Mozos', '/mozos/index'),
            ));
            ?>
        </div> 

        <div data-role="collapsible" data-content-theme="c">
            <h2>Clientes</h2>
            <?php
            echo $this->Jqm->listview(array(
                array('Clientes', '/clientes'),
                array('Descuentos', '/descuentos'),
                array('Tipo de Pagos', '/TipoDePagos'),
            ));
            ?> 
        </div> 

        <div data-role="collapsible" data-content-theme="c">
            <h2>Mesas</h2>
            <?php
            echo $this->Jqm->listview(array(
                array('Listado de Mesas', '/Mesas'),
                array('Nueva Mesa', '/Mesas/add'),
                array('Productos Pedidos', '/detalle_comandas/'),
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
                array('Categorias', '/categorias'),
                array('Tags', '/tags'),
                array('Productos', '/productos'),
                array('Observaciones de Productos', '/observaciones'),
                array('Observaciones de Comandas', '/observacion_comandas'),
                array('Gustos y Sabores', '/sabores'),
                array('Precios Futuros', '/productos_precios_futuros'),
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
                array('Parametros de configuracion', '/configs'),
                array('Configuraciones del sistema', '/configavanzadas'),
                array('Acciones del sistema', '/sistemaconfig'),
            ));
            ?> 
        </div> 

        <div data-role="collapsible" data-content-theme="c">
            <h2>Servidor</h2>
            <?php
            echo $this->Jqm->listview(array(
                array('Enviar informe estadístico', '/cashier/enviar_informe'),
                array('Reiniciar servidor', '/cashier/reiniciar', null, 'Esta accion reinicia el servidor, y no se puede operar el sistema hasta que se vuelva a iniciar.\n¿Desea hacerlo?'),
                array('Apagar servidor', '/cashier/apagar', null, '¿Desea apagar el servidor?.\n'),
            ));
            ?> 
        </div> 
    </div>
  