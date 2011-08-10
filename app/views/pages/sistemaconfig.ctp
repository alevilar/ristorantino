        <?php    
        $menubread=array();
        echo $this->element('menuadmin', array('menubread'=>$menubread));
        ?>

<div class="grid_6 administracion_menu push_4">
    <h1>Acciones del sistema</h1>
    <div class="grid_7 alpha omega">
    <h2>Impresoras</h2>
    <?php
    echo $html->link('CUPS Printer Manager',FULL_BASE_URL.':631').'<br>';
    echo $html->link('Comandera','/Comanderas').'<br>';
    echo $html->link('Listar Dispositivos Fiscales','/cashier/listar_dispositivos').'<br>';
    ?>
    </div>
    
    <div class="grid_7 alpha omega">
    <h2>Configuración</h2>
    <?php
    echo $html->link('Parametros de configuracion','/configs').'<br>';
    echo $html->link('Crear consultas para las estadísticas (avanzado)','/pquery/queries').'<br>';
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
