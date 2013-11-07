<style>
    table.data-activo{
        border: 3px solid #E47211;
    }
    
    h2.data-activo{
        color: white;
        background-color: #E47211;
        margin-bottom: -11px;
        padding-bottom: 11px;
    }
    
    .wrapper1, .wrapper2{
        width: 100%; border: none 0px RED;
    overflow-x: scroll; overflow-y:hidden;}
    .wrapper1{ }
    .wrapper2{}
    .div1 {width:999999px; height: 1px;}
    .div2 {width:999999px; background-color: whitesmoke;
    overflow: auto;}
</style>


<script>
(function($){
    $(function(){
        $(".wrapper1").scroll(function(){
            $(".wrapper2")
                .scrollLeft($(".wrapper1").scrollLeft());
        });
        $(".wrapper2").scroll(function(){
            $(".wrapper1")
                .scrollLeft($(".wrapper2").scrollLeft());
        });
    })
})(jQuery);
</script>


<div class="wrapper1">
    <div class="div1">
    </div>
</div>

<div class="wrapper2">
    
<div class="div2">
<?php
$first = true;
foreach ($fechas as $fecha=>$mozo) {
?>
    <div style="float: left; margin-left: 10px;">
<h2 class="centrado <?= $first ? 'data-activo':'';?>"><?php echo date('d-m-Y',strtotime($fecha))?></h2>
<table class="fecha-<?php echo "fecha"?> <?= $first ? 'data-activo' : ''; $first = false ?>" cellspacing="0" cellpadding="0" style="text-align: center; width: 200px;">
        <thead>
            <tr>
                <th style="text-align: center">Mozo</th>
                <th style="text-align: center">Total</th>
            </tr>
        </thead>
        
        <tbody>
<?php
        foreach($mozo as $m){
            ?>
            <tr>
                <td><?php echo $m['Mozo']['numero']; ?></td>
                <td style="text-align: right">$<?php echo number_format ( $m['Mozo']['total'] , 2 , ',' , $thousands_sep = '.' ); ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>              
    </table>
    </div>
<?php } ?>


</div>
</div>


<div class="col-md-12 alpha omega">
        <?php 
        echo $form->create('Mesa',array('url'=>'/pquery/stats/mozos_total', 'class' => 'formufecha')); 
        ?>

        <h2>Modificar rango de fechas</h2>
            <?php
            echo "Desde: ".$form->text('Linea.0.desde', array('placeholder'=>'Ej: 22/09/2011','id'=>'from', 'class' =>'datepicker'));
            echo "Hasta: ".$form->text('Linea.0.hasta', array('placeholder'=>'Ej: 30/09/2011','id'=>'to', 'class' =>'datepicker'));  
            echo $form->submit('Aceptar', array('class' => '', 'div' => false));
            ?>

        <?php
        echo $form->end();
        ?>

    </div>
