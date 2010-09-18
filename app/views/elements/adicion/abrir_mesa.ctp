

<div id="mesa-abrir" style="display: none">
    <?php
    echo $form->create('Mesa',array('action'=>'abrirMesa'));
    echo $form->input('mozo_id',array('type'=>'hidden','value'=>$current_mozo_id));
    echo $form->input('numero',array('label'=>'','style'=>'float:left;'));
    echo $form->button('Cancelar',array('onclick'=>'Dialog.closeInfo();'));
    echo $form->button('AbrirMesa',array('onclick'=>'abrirlaMesa();'));
    echo $form->end();
    ?>
</div>


<script type="text/javascript">
    <!--


    function abrirlaMesa()
    {
        if($F('MesaNumero')< 600){

            $('MesaMozoId').value = adicion.currentMozo.mozo.id;

            $('MesaAbrirMesaForm').submit();
            return true;
        }
        else{
            Dialog.closeInfo();
            mensajero.error("El Nº de mesa debe ser menor a 600");
            return false;
        }

    }
    //-->
</script>