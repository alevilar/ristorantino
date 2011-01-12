
<script type="text/javascript">

    //console.info('Iniciando aplicacion');


    var fabricaMozo = new FabricaMozo(<?php echo $current_mozo?>);


    var adicion = new Adicion(fabricaMozo.getMozo());
    adicion.urlMesaView = '<? echo $html->url('/Mesas/view');?>';

//    url donde esta el sonido que voy a reproducir cuando haga click en alguna accion
    var urlSonido = '<? echo Configure::read('Sound.url');?>';
    //Sound.play(urlSonido,{replace:true});
   
    
    //NUMPAD ------------------------------------------------------
    var txtNumber = null;
    var numPad = null; //este se tiene que llamar asi para que funcione

    
    /********** PERMISOS DE VISTA DE LOS ELEMENTOS *****/

    var currentUser = <? echo json_encode($session->read('Auth.User'));?>;
    
    Event.observe(document, 'dom:loaded', function(){
        <?php
        if ($current_mesa_id > 0) {
            echo $ajax->remoteFunction(array(
                    'update' => 'mesa-scroll',
                    'url' =>  '/mesas/view/' . $current_mesa_id,
                    'evalScripts' => true
            ));
        }
        ?>
    });

</script>


<?php 

/*------------------------------------------------------------------------------------------------------------------------------------*/
/*-****************************************************-------------------
 * ACA RENDERIZO ELEMENTOS QUE NO SE VEN HASTA QUE SON LLAMADOS
 * 
 * por lo general se usan con los modal windows ventanas y cosas por el estilo
*/
echo $this->renderElement('listar_clientes');		
echo $this->renderElement('loading');
echo $this->renderElement('adicion/comanda_cocina');	
echo $this->renderElement('adicion/comanda_sacar');	
echo $this->renderElement('adicion/abrir_mesa');		
echo $this->renderElement('adicion/imprimir_como_menu');
echo $this->renderElement('adicion/set_comensales');
echo $this->renderElement('adicion/seleccionar_mozo');
/*------------------------------------------------------------------------------------------------------------------------------------*/
?>

<div id="adicion-cabecera">
    <a href="#F5Refresh" id="f5-refresh" class="boton" style="float: left" onclick="parent.location.reload();">
		Refresh
    </a>
    <?php echo $this->renderElement('adicion/cambiar_mesa_listar_todas_abiertas');?>

    <?php echo $this->renderElement('mensajes');?>
</div>	






<div id="mesas-listado">
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
</div>


<script type="text/javascript">
    <!--
    Event.observe('mesas-contenedor', 'click', function(event) {
        var element = Event.element(event);
        //removeClassName,'mesa-seleccionada'
        $$('.mesa-seleccionada').each(function(e){e.removeClassName('mesa-seleccionada')});

        //element.addClassName('mesa-seleccionada');
        if(element.id){
            $(element.id).addClassName('mesa-seleccionada');
        }
    });

    //-->
</script>


<div id="mesa-container">
    <div id="mesa-acciones" class="menu-vertical">
        <ul>
            <!--  Los Eventos ONCLICK se manejan desde sus respectivos elements -->
            <li><a href="#AgregarProducto"  id="boton-comanda">  Comanda </a></li>
            <li><a href="#Comensales"       id="btn-comensales"> Cubiertos</a></li>
            <li><a href="#SeleccionCliente" id="boton-cliente">  Cliente </a></li>
            <li><a href="#ConvertirEnMenu"  id="boton-menu">     Menú    </a></li>

            <li><?php echo $html->link('Cerrar Mesa',"#cerrarMesa",array(
                'onClick'=>'adicion.cerrarCurrentMesa('.Configure::read('cantidadCubiertosObligatorio').')'));?></li>

            <li><a href="#SacarProducto"    id="boton-sacar-item">  Sacar Item </a></li>
        </ul>
    </div>


    <div id="mesa-acciones-2" class="menu-vertical">
        <ul>
                <li><a href="#cancelarCierreDeMesa" onclick="adicion.reabrirMesa('<?= $html->url('/mesas/ajax_edit')?>')">Re Abrir Mesa</a></li>
                <li><a href="#Reimprimir" onclick="adicion.currentMesa.reimprimir('<?= $html->url('/mesas/imprimirTicket')?>')">Re Print Ticket</a></li>
                <li><a href="#Reimprimir" onclick="adicion.borrarMesa('<?= $html->url('/mesas/delete')?>')">Borrar</a></li>
        </ul>
    </div>

    <div id="mesa-data">
        <div  id="mesa-scroll">	</div>
    </div>
</div>


<?php echo $this->renderElement('mesas_scroll');?>


<div id="sistem-nav">
    <?php echo $html->link('SALIR','/pages/home', array('class'=>'boton-ancho-largo'))?>
</div>




