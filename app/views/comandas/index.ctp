        <?php    
            echo $this->element('menuadmin');
        ?>
<div class="comandas index">

<h2>Listado de Comandas de mesas abiertas</h2>

    <table class="table">
        <thead>
        <tr>
            <th>#Comanda</th>
            <th>Mesa</th>
            <th>Hora Impresión</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
<?php 
if(!empty($comandas)){
        foreach($comandas as $c): ?>
        <tr>
            <td><?php echo $c['Comanda']['id']?></td>
            <td><?php echo $c['Mesa']['numero']?></td>
            <td><?php echo date('H:i:s',strtotime($c['Comanda']['created']))?></td>
            <td><?php echo $html->link(' Reimprimir comanda',array('action'=>'imprimir',$c['Comanda']['id']), array('style'=>'color:red;font-weight:bold')  ); ?></td>
        </tr>
<?php endforeach;
}else {
    echo ('No hay comandas activas');
}
?>
        </tbody>
</table>
</div>

