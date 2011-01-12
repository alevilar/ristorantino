
<div id="mesa-abrir" style="display: none">
    <?php
    /* @var $form FormHelper */
    $form;
//    echo $ajax->form('abrirMesa', 'post', array(
//            'model' => 'Mesa',
//            'id' => 'MesaAbrirMesaForm',
//            'update'=>'mesa-data',
//            ));

    
    echo $form->create('Mesa',  array(
            //'action' => 'abrirMesa',
            'url' => 'abrirMesa',
            'id' => 'MesaAbrirMesaForm',
            'update'=>'mesa-data',
            ));
    echo $form->input('mozo_id',array('type'=>'hidden','value'=>$current_mozo_id));
    echo $form->input('numero',array('label'=>'','style'=>'float:left;'));
    echo $form->button('Cancelar',array('onclick'=>'Dialog.closeInfo();'));
    echo $form->button('AbrirMesa',array('onclick'=>'abrirlaMesa();'));
    echo $form->end();
    ?>
</div>


<script type="text/javascript">

    function abrirlaMesa()
    {
        if (adicion.currentMozo.mozo){
            $('MesaMozoId').value = adicion.currentMozo.mozo.id;
        }

        $('MesaAbrirMesaForm').submit();
        return true;
    }
    
</script>