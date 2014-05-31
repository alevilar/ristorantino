<?php
echo $this->element('menuadmin');
?>

<div class="administracion_menu">
    <h1>Configuraciones del sistema</h1>
    <div class="col-md-6 ">
        </br></br>
        <?php
        echo $html->link('Tipos de Documentos', '/tipo_documentos') . '<br>';
        echo $html->link('IVA Responsabilidades', '/iva_responsabilidades') . '<br>';
        echo $html->link('Permisos de usuarios', '/admin/acl') . '<br>';
        ?>
        </br></br>
    </div>
    <div class="col-md-6 ">
        <h2>Impresoras</h2>
        <?php
        echo $html->link('CUPS Printer Manager', FULL_BASE_URL . ':631') . '<br>';
        echo $html->link('Comandera', '/Comanderas') . '<br>';
        echo $html->link('Listar Dispositivos Fiscales', '/cashier/listar_dispositivos') . '<br>';
        ?>

        <h2>Estadisticas</h2>
        <?php
        echo $html->link('Crear consultas para las estadísticas (avanzado)', '/pquery/queries') . '<br>';
        ?>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
