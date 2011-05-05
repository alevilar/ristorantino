<?php echo $this->renderElement('adicion/cambiar_mozo');?>

    <div id="LeftArrow">
        <?= $html->link("Izquierda", '#moveLeft',
                //opciones extra
                array(
                'escape' => false,
                'class'=>'arrow boton-simple',
                'onClick'=>"MoveMesaLeft()",
                'alt'=>'Mover a la izquierda',
        ));?>
    </div>

    <div id="ScrollMesaBox">
        <ul  id="mesas-contenedor">
            <li><?php echo $html->link(' + ','#AbrirMesa',array('onclick'=>"adicion.abrirMesa(); return false;",
                'class'=>'boton-simple','id'=>'abrir-mesa'))?></li>

            <?php
                if (!empty($this->data['Mesa'])) {
                    foreach ($this->data['Mesa'] as $m):?>
                <?php $add_class = ($m['time_cerro'] !=  '0000-00-00 00:00:00')?' mesa-cerrada':'';?>
                <?php echo '<li>'.$ajax->link($m['numero'],'/mesas/view/'.$m['id'], array( 	'update'=>'mesa-scroll',
                        'id'=>'mesa-ver-'.$m['id'],
                        'class'=>'boton redondeado-arriba '.$add_class,
                        'evalScripts'=>true
                        )).'</li>'
                ?>
            <?php
                    endforeach;
                }
                ?>
        </ul>
    </div>


    <div id="RightArrow">
        <?= $html->link("Derecha",
                '#moveRight',
                //opciones extra
                array(	'escape' => false,
                'class'=>'arrow boton-simple',
                'onClick'=>"MoveMesaRight()",
                'alt'=>'Mover a la derecha'));?>

    </div>  